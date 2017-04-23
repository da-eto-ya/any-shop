<?php

namespace AppBundle\Criteria;

/**
 * Class ProductSearchCriteria
 * Criteria to search products.
 *
 * @package AppBundle\Criteria
 */
class ProductSearchCriteria
{
    /** @var string product text query */
    private $query = '';

    /**
     * Set product text query.
     *
     * @param string $query
     *
     * @return ProductSearchCriteria
     */
    public function setQuery(string $query): ProductSearchCriteria
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get product text query.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}
