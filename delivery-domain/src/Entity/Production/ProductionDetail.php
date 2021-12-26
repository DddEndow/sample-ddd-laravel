<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Production;

use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\OrderDetail;

class ProductionDetail
{
    private function __construct(
        public readonly ItemId $itemId,
        public readonly int $output,
        /** @var OrderDetail[] */
        public readonly array $orderDetailIds
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        ItemId $itemId,
        int $output,
        /** @var OrderDetail[] */
        array $orderDetailIds
    ): ProductionDetail {
        return new ProductionDetail(
            itemId: $itemId,
            output: $output,
            orderDetailIds: $orderDetailIds
        );
    }

    static public function reconstruct(
        string $itemId,
        int $output,
        /** @var OrderDetail[] */
        array $orderDetailIds
    ): ProductionDetail {
        return new ProductionDetail(
            itemId: ItemId::from($itemId),
            output: $output,
            orderDetailIds: $orderDetailIds
        );
    }
}
