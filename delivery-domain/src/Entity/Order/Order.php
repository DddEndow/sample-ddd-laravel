<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Order;

use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;
use Delivery\Domain\Exceptions\DomainException;

class Order
{
    private function __construct(
        public readonly OrderId $orderId,
        public readonly StoreId $orderedStoreId,
        public readonly DateTime $registrationOrderDatetime,
        public readonly ?DateTime $scheduledDeliveryDatetime,
        /** @var OrderDetail[] */
        public readonly array $orderDetails
    ) {}

    public function closeOrder(): Order
    {
        // TODO scheduledDeliveryDatetimeがnullであることのバリデーション
        // TODO 現在時刻がregistrationOrderDatetimeよりもあとであることのバリデーション
        // TODO orderDetailsが空ではないことを確認するバリデーション
        return new Order(
            orderId: $this->orderId,
            orderedStoreId: $this->orderedStoreId,
            registrationOrderDatetime: $this->registrationOrderDatetime,
            scheduledDeliveryDatetime: DateTime::now(),
            orderDetails: $this->orderDetails
        );
    }

    public function addDetail(OrderDetail $detail): Order
    {
        $this->validateOrderClosing();
        $this->validateItemTotalQuantity($detail);
        return new Order(
            orderId: $this->orderId,
            orderedStoreId: $this->orderedStoreId,
            registrationOrderDatetime: $this->registrationOrderDatetime,
            scheduledDeliveryDatetime: $this->scheduledDeliveryDatetime,
            orderDetails: array_merge($this->orderDetails, [$detail])
        );
    }

    // -------- private functions --------

    private function validateOrderClosing(): void
    {
        if ($this->scheduledDeliveryDatetime)
            throw new DomainException("発注を締めた後に発注明細を変更することはできません。");
    }

    private function validateItemTotalQuantity(OrderDetail $target): void
    {
        $currentOrderDetails = array_filter(
            $this->orderDetails,
            fn(OrderDetail $detail): bool => $detail->itemId->value === $target->itemId->value
        );

        $totalQuantity = $target->quantity;
        /** @var OrderDetail $currentDetail */
        foreach ($currentOrderDetails as $currentDetail) {
            $totalQuantity += $currentDetail->quantity;
        }

        if ($totalQuantity < 0)
            throw new DomainException("商品の発注数の合計は0以上になるようにしてください。商品ID: {$target->itemId->value}");
    }

    // -------- static functions --------

    static public function create(
        StoreId $orderedStoreId,
        DateTime $registrationOrderDatetime,
    ): Order {
        return new Order(
            orderId: OrderId::gen(),
            orderedStoreId: $orderedStoreId,
            registrationOrderDatetime: $registrationOrderDatetime,
            scheduledDeliveryDatetime: null,
            orderDetails: []
        );
    }

    static public function reconstruct(
        OrderId $orderId,
        StoreId $orderedStoreId,
        DateTime $registrationOrderDatetime,
        ?DateTime $scheduledDeliveryDatetime,
        /** @var OrderDetail[] */
        array $orderDetails
    ): Order {
        return new Order(
            orderId: $orderId,
            orderedStoreId: $orderedStoreId,
            registrationOrderDatetime: $registrationOrderDatetime,
            scheduledDeliveryDatetime: $scheduledDeliveryDatetime,
            orderDetails: $orderDetails
        );
    }
}
