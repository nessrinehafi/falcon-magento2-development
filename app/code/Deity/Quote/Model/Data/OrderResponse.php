<?php
declare(strict_types=1);

namespace Deity\Quote\Model\Data;

use Deity\QuoteApi\Api\Data\OrderResponseInterface;
use Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface;
use Magento\Framework\Api\ExtensionAttributesFactory;

/**
 * Class OrderResponse
 * @package Deity\Quote\Model\Data
 */
class OrderResponse implements OrderResponseInterface
{

    /**
     * @var OrderResponseExtensionInterface
     */
    private $extensionAttributes;

    /**
     * @var ExtensionAttributesFactory
     */
    private $extensionAttributesFactory;

    /**
     * @var string
     */
    private $orderId;

    /**
     * @var string
     */
    private $orderRealId;

    /**
     * OrderResponse constructor.
     * @param string $orderId
     * @param string $orderRealId
     * @param ExtensionAttributesFactory $extensionAttributesFactory
     */
    public function __construct(
        string $orderId,
        string $orderRealId,
        ExtensionAttributesFactory $extensionAttributesFactory
    ) {
        $this->orderId = $orderId;
        $this->orderRealId = $orderRealId;
        $this->extensionAttributesFactory = $extensionAttributesFactory;
    }


    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getOrderRealId(): string
    {
        return $this->orderRealId;
    }

    /**
     * @return \Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface
     */
    public function getExtensionAttributes()
    {
        if (!$this->extensionAttributes) {
            $this->extensionAttributes = $this->extensionAttributesFactory->create(OrderResponseInterface::class);
        }

        return $this->extensionAttributes;
    }

    /**
     * @param \Deity\QuoteApi\Api\Data\OrderResponseExtensionInterface $extensionAttributes
     * @return \Deity\QuoteApi\Api\Data\OrderResponseInterface
     */
    public function setExtensionAttributes(OrderResponseExtensionInterface $extensionAttributes)
    {
        $this->extensionAttributes = $extensionAttributes;
        return $this;
    }
}
