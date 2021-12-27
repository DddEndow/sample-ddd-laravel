<?php

declare(strict_types=1);

namespace App\UseCases\Item;

use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Item\ItemRepository;

class ListItemsUseCase
{
    public function __construct(
        private ItemRepository $itemRepository
    ) {}

    /**
     * @return Item[]
     */
    public function invoke(): array
    {
        return $this->itemRepository->list();
    }
}
