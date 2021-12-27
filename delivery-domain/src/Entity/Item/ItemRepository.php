<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Item;

interface ItemRepository
{
    /**
     * @return Item[]
     */
    public function list(): array;
}
