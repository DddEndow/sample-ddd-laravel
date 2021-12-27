<?php

namespace Delivery\Infra\Tests\DataCreators;

use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\Models\Item as ItemModel;

class ItemDataCreator
{
    public function create(
        Name $name,
        int $price
    ): Item {
        $item = Item::create(
            name: $name,
            price: $price
        );
        ItemModel::factory()->create([
            'item_id' => $item->itemId->value,
            'name' => $item->name->value,
            'price' => $item->price
        ]);
        return $item;
    }
}
