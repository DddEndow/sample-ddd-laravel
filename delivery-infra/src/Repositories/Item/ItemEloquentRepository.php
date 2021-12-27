<?php

declare(strict_types=1);

namespace Delivery\Infra\Repositories\Item;

use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Item\ItemRepository;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\Models\Item as ItemModel;

class ItemEloquentRepository implements ItemRepository
{
    /**
     * @return Item[]
     */
    public function list(): array
    {
        return ItemModel::all()->map(fn(ItemModel $model): Item => Item::reconstruct(
            itemId: ItemId::from($model->item_id),
            name: Name::of($model->name),
            price: $model->price
        ))->all();
    }
}
