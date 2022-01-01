<?php

declare(strict_types=1);

namespace App\Http\Views\Order;

use Delivery\Domain\Entity\Order\Order;
use Spatie\LaravelData\Data;

class OrderView extends Data
{
    public function __construct(
        public string $orderId,
        public string $orderedStoreId,
        public string $registrationOrderDatetime,
        public ?string $scheduledDeliveryDatetime,
    ) {}

    static public function of(Order $order): self
    {
        return new self(
            orderId: $order->orderId->value,
            orderedStoreId: $order->orderedStoreId->value,
            registrationOrderDatetime: $order->registrationOrderDatetime->value->format('Y-m-d: H:i:s'),
            scheduledDeliveryDatetime: $order->scheduledDeliveryDatetime?->value->format('Y-m-d: H:i:s'),
        );
    }
}
