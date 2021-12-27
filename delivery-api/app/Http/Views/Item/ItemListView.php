<?php

declare(strict_types=1);

namespace App\Http\Views\Item;

use Delivery\Domain\Entity\Item\Item;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ItemListView extends Data
{
    public function __construct(
        /** @var ItemView[] */
        public DataCollection $items
    ) {}

    /**
     * @param Item[] $items
     * @return $this
     */
    static public function of(array $items): self
    {
        return new self(ItemView::collection(
            array_map(fn(Item $item): ItemView => ItemView::of($item), $items)
        ));
    }
}
