<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Item;

use Delivery\Domain\Entity\Shared\Name;

class Item
{
    private function __construct(
        public readonly ItemId $itemId,
        public readonly Name $name,
        public readonly int $price,
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        Name $name,
        int $price,
    ): Item {
        return new Item(
            itemId: ItemId::gen(),
            name: $name,
            price: $price,
        );
    }

    static public function reconstruct(
        ItemId $itemId,
        Name $name,
        int $price,
    ): Item {
        return new Item(
            itemId: $itemId,
            name: $name,
            price: $price,
        );
    }
}
