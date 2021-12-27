<?php

declare(strict_types=1);

namespace App\Http\Views\Item;

use Delivery\Domain\Entity\Item\Item;
use Spatie\LaravelData\Data;

class ItemView extends Data
{
    public function __construct(
        public string $itemId,
        public string $name,
        public int $price
    ) {}

    static public function of(Item $item): self
    {
        return new self(
            itemId: $item->itemId->value,
            name: $item->name->value,
            price: $item->price
        );
    }
}
