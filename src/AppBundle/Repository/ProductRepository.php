<?php

namespace AppBundle\Repository;

use AppBundle\Criteria\ProductSearchCriteria;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 */
class ProductRepository extends EntityRepository
{
    private const LIKE_ESCAPE_CHAR = '!';

    /**
     * Search products by specific criteria.
     *
     * @param ProductSearchCriteria $criteria
     *
     * @return Product[]|array
     */
    public function search(ProductSearchCriteria $criteria)
    {
        $builder = $this->createQueryBuilder('p');

        if ($criteria->getQuery()) {
            $builder->andWhere("p.title LIKE :titleLike ESCAPE '".self::LIKE_ESCAPE_CHAR."'");
            $builder->setParameter('titleLike', $this->createLikeAnywherePattern($criteria->getQuery()));
        }

        return $builder->getQuery()->getResult();
    }

    /**
     * @param string $text
     *
     * @return string
     */
    private function createLikeAnywherePattern(string $text)
    {
        $pattern = sprintf(
            '/([%s])/',
            join(
                '',
                [
                    '\\'.self::LIKE_ESCAPE_CHAR,
                    '\%',
                    '\_',
                ]
            )
        );

        return '%'.preg_replace($pattern, self::LIKE_ESCAPE_CHAR.'$0', $text).'%';
    }
}
