<?php
declare(strict_types=1);

namespace Deity\CatalogSearch\Model\QueryCollection;

use Deity\CatalogSearchApi\Api\QueryCollectionProcessorInterface;
use Deity\CatalogSearchApi\Api\QueryCollectionServiceInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Class QueryCollectionService
 *
 * @package Deity\CatalogSearch\Model
 */
class Service implements QueryCollectionServiceInterface
{
    /**
     * @var QueryCollectionProcessorInterface[]
     */
    protected $applySearchQueryProcessors = [];

    /**
     * CollectionProcessor constructor.
     *
     * @param QueryCollectionProcessorInterface[] $applySearchQueryProcessors
     *
     * @return void
     */
    public function __construct(
        $applySearchQueryProcessors = []
    ) {
        $this->applySearchQueryProcessors = $applySearchQueryProcessors;
    }

    /**
     * Executes all processors and applies query to collection
     *
     * @param Collection $collection
     * @param string $query
     *
     * @return void
     */
    public function apply(Collection $collection, string $query)
    {
        foreach ($this->applySearchQueryProcessors as $searchQueryProcessor) {
            $searchQueryProcessor->applySearchQueryToCollection($collection, $query);
        }
    }
}
