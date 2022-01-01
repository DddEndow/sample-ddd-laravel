<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Order;

use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Order\OrderRepository;

class ListOrdersUseCase
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {}

    /**
     * @return array<Order>
     */
    public function invoke(): array
    {
        return $this->orderRepository->list();
    }
}
