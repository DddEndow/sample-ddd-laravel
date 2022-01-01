<?php

declare(strict_types=1);

namespace Delivery\Infra\Repositories\Order;

use Delivery\Domain\Entity\Delivery\DeliveryId;
use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Order\OrderDetail;
use Delivery\Domain\Entity\Order\OrderDetailId;
use Delivery\Domain\Entity\Order\OrderId;
use Delivery\Domain\Entity\Order\OrderRepository;
use Delivery\Domain\Entity\Production\ProductionId;
use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;
use Delivery\Infra\Models\Order as OrderModel;
use Delivery\Infra\Models\OrderDetail as OrderDetailModel;

class OrderEloquentRepository implements OrderRepository
{
    /**
     * @return Order[]
     */
    public function list(): array
    {
        return OrderModel::with('orderDetails')->get()
            ->map(fn (OrderModel $orderModel): Order => Order::reconstruct(
                orderId: OrderId::from($orderModel->order_id),
                orderedStoreId: StoreId::from($orderModel->store_id),
                registrationOrderDatetime: DateTime::fromString($orderModel->registration_order_datetime),
                scheduledDeliveryDatetime: $orderModel->scheduled_delivery_datetime
                    ? DateTime::fromString($orderModel->scheduled_delivery_datetime)
                    : null,
                orderDetails: array_map(fn(OrderDetailModel $orderDetailModel): OrderDetail => OrderDetail::reconstruct(
                    orderDetailId: OrderDetailId::from($orderDetailModel->order_detail_id),
                    itemId: ItemId::from($orderDetailModel->item_id),
                    productionId: $orderDetailModel->production_id
                        ? ProductionId::from($orderDetailModel->production_id)
                        : null,
                    deliveryId: $orderDetailModel->delivery_id
                        ? DeliveryId::from($orderDetailModel->delivery_id)
                        : null,
                    quantity: $orderDetailModel->quantity
                ), $orderModel->orderDetails->all())
            ))->all();
    }
}
