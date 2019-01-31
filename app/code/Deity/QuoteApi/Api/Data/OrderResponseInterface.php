<?php
declare(strict_types=1);

namespace Deity\QuoteApi\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface OrderResponseInterface extends ExtensibleDataInterface
{
    const ORDER_ID = 'orderId';
    const ORDER_REAL_ID = 'orderRealId';

    /**
     * @return string
     */
    public function getOrderId(): string;

    /**
     * @return string
     */
    public function getOrderRealId(): string;

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface $extensionAttributes
    );
}
