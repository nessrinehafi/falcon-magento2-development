<?php
declare(strict_types=1);

namespace Deity\CatalogSearch\Model;

use Deity\CatalogApi\Api\Data\ProductSearchResultsInterface;
use Deity\CatalogApi\Api\Data\ProductSearchResultsInterfaceFactory;
use Deity\CatalogApi\Api\ProductConvertInterface;
use Deity\CatalogApi\Api\ProductFilterProviderInterface;
use Deity\CatalogSearchApi\Api\SearchInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Api\Search\SearchInterface as SearchApiProviderInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Class CatalogSearchProductList
 * @package Deity\CatalogSearch\Model
 */
class CatalogSearchProductList implements SearchInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Resolver
     */
    private $layerResolver;

    /**
     * @var SearchApiProviderInterface
     */
    private $searchApiProvider;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var \Magento\Catalog\Model\Layer\Search
     */
    private $searchLayer;

    /**
     * @var ProductSearchResultsInterfaceFactory
     */
    private $productSearchResultFactory;

    /**
     * @var ProductConvertInterface
     */
    private $productConverter;

    /**
     * @var ProductFilterProviderInterface
     */
    private $filterProvider;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * CatalogSearchProductList constructor.
     * @param ProductSearchResultsInterfaceFactory $productSearchResultFactory
     * @param ProductConvertInterface $convert
     * @param Resolver $layerResolver
     * @param ProductRepositoryInterface $productRepository
     * @param ProductFilterProviderInterface $productFilterProvider
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchApiProviderInterface $searchApiProvider
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ProductSearchResultsInterfaceFactory $productSearchResultFactory,
        ProductConvertInterface $convert,
        Resolver $layerResolver,
        ProductRepositoryInterface $productRepository,
        ProductFilterProviderInterface $productFilterProvider,
        CollectionProcessorInterface $collectionProcessor,
        SearchApiProviderInterface $searchApiProvider,
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionProcessor = $collectionProcessor;
        $this->filterProvider = $productFilterProvider;
        $this->productConverter = $convert;
        $this->productSearchResultFactory = $productSearchResultFactory;
        $this->searchApiProvider = $searchApiProvider;
        // this is required to create search layer rather than catalog
        $layerResolver->create('search');
        $this->searchLayer = $layerResolver->get();
        $this->layerResolver = $layerResolver;
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Make Full Text Search and return found Documents
     *
     * @param \Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria
     * @return ProductSearchResultsInterface
     */
    public function search(\Magento\Framework\Api\Search\SearchCriteriaInterface $searchCriteria): ProductSearchResultsInterface
    {
        $responseProducts = [];
        $collection = $this->collectionFactory->create();
        $collection->setOrder('relevance');
        $collection->addAttributeToSelect(['name', 'sku', 'image']);
        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();

        foreach ($collection->getItems() as $product) {
            $responseProducts[] = $this->productConverter->convert(
                $product
            );
        }

        $productSearchResult = $this->productSearchResultFactory->create();
        $productSearchResult->setFilters(
            $this->filterProvider->getFilterList($this->layerResolver->get())
        );
        $productSearchResult->setItems($responseProducts);
        $productSearchResult->setTotalCount(count($responseProducts));
        return $productSearchResult;
    }

}
