<?php

namespace AppBundle\Criteria;

use AppBundle\Entity\Category;

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

    /** @var Category|null product category */
    private $category = null;

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

    /**
     * @param Category|null $category
     *
     * @return ProductSearchCriteria
     */
    public function setCategory(?Category $category): ProductSearchCriteria
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }
}
