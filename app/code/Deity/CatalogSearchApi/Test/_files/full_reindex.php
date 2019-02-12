<?php
$indexerCollectionFactory = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
    \Magento\Indexer\Model\Indexer\CollectionFactory::class
);
$indexerCollection = $indexerCollectionFactory->create();
foreach ($indexerCollection->getItems() as $indexer) {
    $indexer->reindexAll();
}
