<?php

declare(strict_types=1);

namespace App\Http\Views\Order;

use Delivery\Domain\Entity\Order\Order;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OrderListView extends Data
{
    public function __construct(
        /** @var OrderView[] */
        public DataCollection $orders
    ) {}

    /**
     * @param Order[] $orders
     * @return $this
     */
    static public function of(array $orders): self
    {
        return new self(OrderView::collection(
            array_map(fn(Order $order): OrderView => OrderView::of($order), $orders)
        ));
    }
}
