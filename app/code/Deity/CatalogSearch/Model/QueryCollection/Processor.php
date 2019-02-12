<?php
declare(strict_types=1);

namespace Deity\CatalogSearch\Model\QueryCollection;

use Deity\CatalogSearchApi\Api\QueryCollectionProcessorInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Class QueryCollectionProcessor
 *
 * @package Deity\CatalogSearch\Model
 */
class Processor implements QueryCollectionProcessorInterface
{
    /**
     * Applies query string to collection
     *
     * @param Collection $collection
     * @param string $query
     *
     * @return void
     */
    public function applySearchQueryToCollection(Collection $collection, string $query)
    {
        $collection->addSearchFilter($query);
    }
}
