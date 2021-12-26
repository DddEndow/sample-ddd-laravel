<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Item;

class Item
{
    private function __construct(
        public readonly ItemId $itemId,
        public readonly string $name,
        public readonly int $price,
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        string $name,
        int $price,
    ): Item {
        return new Item(
            itemId: ItemId::gen(),
            name: $name,
            price: $price,
        );
    }

    static public function reconstruct(
        string $itemId,
        string $name,
        int $price,
    ): Item {
        return new Item(
            itemId: ItemId::from($itemId),
            name: $name,
            price: $price,
        );
    }
}
