<?php

namespace Delivery\Infra\Tests\DataCreators;

use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\Store;
use Delivery\Infra\Models\Order as OrderModel;

class OrderDataCreator
{
    public function create(
        Store $orderedStore,
        DateTime $registrationOrderDatetime
    ): Order {
        $order = Order::create(
            orderedStoreId: $orderedStore->storeId,
            registrationOrderDatetime: $registrationOrderDatetime
        );
        OrderModel::factory()->create([
            'order_id' => $order->orderId->value,
            'store_id' => $order->orderedStoreId->value,
            'registration_order_datetime' => $order->registrationOrderDatetime->value,
            'scheduled_delivery_datetime' => $order->scheduledDeliveryDatetime?->value
        ]);
        return $order;
    }
}
