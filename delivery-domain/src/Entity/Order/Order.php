<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Order;

use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;

class Order
{
    private function __construct(
        public readonly OrderId $orderId,
        public readonly StoreId $orderedStoreId,
        public readonly DateTime $registrationOrderDatetime,
        public readonly ?DateTime $scheduledDeliveryDatetime,
        /** @var OrderDetail[] */
        public readonly array $orderDetails
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        StoreId $orderedStoreId,
        DateTime $registrationOrderDatetime,
        /** @var OrderDetail[] */
        array $orderDetails
    ): Order {
        return new Order(
            orderId: OrderId::gen(),
            orderedStoreId: $orderedStoreId,
            registrationOrderDatetime: $registrationOrderDatetime,
            scheduledDeliveryDatetime: null,
            orderDetails: $orderDetails
        );
    }

    static public function reconstruct(
        string $orderId,
        string $orderedStoreId,
        DateTime $registrationOrderDatetime,
        ?DateTime $scheduledDeliveryDatetime,
        /** @var OrderDetail[] */
        array $orderDetails
    ): Order {
        return new Order(
            orderId: OrderId::from($orderId),
            orderedStoreId: StoreId::from($orderedStoreId),
            registrationOrderDatetime: $registrationOrderDatetime,
            scheduledDeliveryDatetime: $scheduledDeliveryDatetime,
            orderDetails: $orderDetails
        );
    }
}
