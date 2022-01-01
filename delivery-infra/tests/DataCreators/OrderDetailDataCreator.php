<?php

namespace Delivery\Infra\Tests\DataCreators;

use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Order\OrderDetail;
use Delivery\Infra\Models\OrderDetail as OrderDetailModel;

class OrderDetailDataCreator
{
    public function create(
        Order $order,
        Item $item,
        int $quantity = 100
    ): OrderDetail {
        $orderDetail = OrderDetail::create(
            itemId: $item->itemId,
            quantity: $quantity
        );
        OrderDetailModel::factory()->create([
            'order_id' => $order->orderId->value,
            'order_detail_id' => $orderDetail->orderDetailId->value,
            'item_id' => $orderDetail->itemId->value,
            'production_id' => $orderDetail->productionId?->value,
            'delivery_id' => $orderDetail->deliveryId?->value,
            'quantity' => $orderDetail->quantity
        ]);
        return $orderDetail;
    }
}
