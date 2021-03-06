<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Order;

use Delivery\Domain\Entity\Delivery\DeliveryId;
use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Production\ProductionId;

class OrderDetail
{
    private function __construct(
        public readonly OrderDetailId $orderDetailId,
        public readonly ItemId $itemId,
        public readonly ?ProductionId $productionId,
        public readonly ?DeliveryId $deliveryId,
        public readonly int $quantity
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        ItemId $itemId,
        int $quantity
    ): OrderDetail {
        return new OrderDetail(
            orderDetailId: OrderDetailId::gen(),
            itemId: $itemId,
            productionId: null,
            deliveryId: null,
            quantity: $quantity
        );
    }

    static public function reconstruct(
        OrderDetailId $orderDetailId,
        ItemId $itemId,
        ?ProductionId $productionId,
        ?DeliveryId $deliveryId,
        int $quantity
    ): OrderDetail {
        return new OrderDetail(
            orderDetailId: $orderDetailId,
            itemId: $itemId,
            productionId: $productionId,
            deliveryId: $deliveryId,
            quantity: $quantity
        );
    }
}
