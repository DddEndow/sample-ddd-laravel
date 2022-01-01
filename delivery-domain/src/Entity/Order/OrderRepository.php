<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Order;

interface OrderRepository
{
    /**
     * @return Order[]
     */
    public function list(): array;
}
