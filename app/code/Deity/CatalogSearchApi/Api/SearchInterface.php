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
     * @return \Deity\CatalogApi\Api\Data\ProductSearchResultsInterface
     */
    public function search(\Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria) : \Deity\CatalogApi\Api\Data\ProductSearchResultsInterface;
}