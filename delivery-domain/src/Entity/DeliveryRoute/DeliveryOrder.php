<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\DeliveryRoute;

use Delivery\Domain\Entity\Store\StoreId;

class DeliveryOrder
{
    private function __construct(
        public readonly int $deliveryOrder,
        public readonly StoreId $deliveryStoreId
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        int $deliveryOrder,
        StoreId $deliveryStoreId
    ): DeliveryOrder {
        return new DeliveryOrder(
            deliveryOrder: $deliveryOrder,
            deliveryStoreId: $deliveryStoreId
        );
    }

    static public function reconstruct(
        int $deliveryOrder,
        string $deliveryStoreId
    ): DeliveryOrder {
        return new DeliveryOrder(
            deliveryOrder: $deliveryOrder,
            deliveryStoreId: StoreId::from($deliveryStoreId)
        );
    }
}
