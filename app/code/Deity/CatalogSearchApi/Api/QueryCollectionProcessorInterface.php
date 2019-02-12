<?php
declare(strict_types=1);

namespace Deity\CatalogSearchApi\Api;

use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Class QueryCollectionProcessorInterface
 * @package Deity\CatalogSearch\Model
 */
interface QueryCollectionProcessorInterface
{
    /**
     * Applies query to collection - engine specific
     *
     * @param Collection $collection
     * @param string $query
     *
     * @return void
     */
    public function applySearchQueryToCollection(Collection $collection, string $query);
}
