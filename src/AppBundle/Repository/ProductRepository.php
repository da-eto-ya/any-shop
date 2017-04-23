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
            $builder->andWhere("LOWER(p.title) LIKE LOWER(:titleLike) ESCAPE '".self::LIKE_ESCAPE_CHAR."'");
            $builder->setParameter(
                'titleLike',
                $this->createLikeAnywherePattern($criteria->getQuery(), self::LIKE_ESCAPE_CHAR)
            );
        }

        return $builder->getQuery()->getResult();
    }

    /**
     * Create "search anywhere" pattern for LIKE expression ('some' => '%some%')
     *
     * @param string $text
     * @param string $escapeChar
     *
     * @return string
     */
    private function createLikeAnywherePattern(string $text, string $escapeChar = self::LIKE_ESCAPE_CHAR)
    {
        $pattern = sprintf(
            '/([%s])/',
            join(
                '',
                [
                    '\\'.$escapeChar,
                    '\%',
                    '\_',
                ]
            )
        );

        return '%'.preg_replace($pattern, $escapeChar.'$0', $text).'%';
    }
}
