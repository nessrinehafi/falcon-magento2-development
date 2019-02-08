<?php
declare(strict_types=1);

namespace Deity\CatalogSearchApi\Api;

/**
 * Search API for all requests
 *
 * @api
 */
interface SearchInterface
{
    /**
     * Return products
     *
     * @param \Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria
     * @param string $query
     * @return \Deity\CatalogApi\Api\Data\ProductSearchResultsInterface
     */
    public function search(\Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria, $query) :
        \Deity\CatalogApi\Api\Data\ProductSearchResultsInterface;
}
