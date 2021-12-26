<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Delivery;

use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\OrderDetail;

class DeliveryDetail
{
    private function __construct(
        public readonly ItemId $itemId,
        public readonly int $quantity,
        /** @var OrderDetail[] */
        public readonly array $orderDetailIds
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        ItemId $itemId,
        int $quantity,
        /** @var OrderDetail[] */
        array $orderDetailIds
    ): DeliveryDetail {
        return new DeliveryDetail(
            itemId: $itemId,
            quantity: $quantity,
            orderDetailIds: $orderDetailIds
        );
    }

    static public function reconstruct(
        string $itemId,
        int $quantity,
        /** @var OrderDetail[] */
        array $orderDetailIds
    ): DeliveryDetail {
        return new DeliveryDetail(
            itemId: ItemId::from($itemId),
            quantity: $quantity,
            orderDetailIds: $orderDetailIds
        );
    }
}
