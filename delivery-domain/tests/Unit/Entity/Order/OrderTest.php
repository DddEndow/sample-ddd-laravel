<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\Entity\Order;

use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Order\OrderDetail;
use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;
use Delivery\Domain\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_Orderを作成できること(): void
    {
        // given:
        $orderedStoreId = StoreId::gen();
        $registrationOrderDatetime = DateTime::fromString('2022-01-01');

        // when:
        $result = Order::create(
            orderedStoreId: $orderedStoreId,
            registrationOrderDatetime: $registrationOrderDatetime
        );

        // then:
        $this->assertEquals($orderedStoreId, $result->orderedStoreId);
        $this->assertEquals($registrationOrderDatetime, $result->registrationOrderDatetime);
        $this->assertEquals(null, $result->scheduledDeliveryDatetime);
        $this->assertEquals([], $result->orderDetails);
    }

    public function test_発注明細を追加できること(): void
    {
        // given:
        $orderedStoreId = StoreId::gen();
        $registrationOrderDatetime = DateTime::fromString('2022-01-01');
        $order = Order::create($orderedStoreId, $registrationOrderDatetime);
        $itemId = ItemId::gen();
        $orderDetail = OrderDetail::create($itemId, 10);

        // when:
        $result = $order->addDetail($orderDetail);

        // then:
        $this->assertEquals([$orderDetail], $result->orderDetails);
    }

    public function test_発注を締めた後に発注明細を追加しようとするとエラーになること(): void
    {
        // given:
        $orderedStoreId = StoreId::gen();
        $registrationOrderDatetime = DateTime::fromString('2022-01-01');
        $order = Order::create($orderedStoreId, $registrationOrderDatetime);
        $itemId = ItemId::gen();
        $orderDetail = OrderDetail::create($itemId, 10);

        // when:
        $closedOrder = $order->closeOrder();

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("発注を締めた後に発注明細を変更することはできません。");
        $closedOrder->addDetail($orderDetail);
    }

    public function test_商品の合計発注数がマイナスになる発注詳細を登録しようとするとエラーになること(): void
    {
        // given:
        $orderedStoreId = StoreId::gen();
        $registrationOrderDatetime = DateTime::fromString('2022-01-01');
        $order = Order::create($orderedStoreId, $registrationOrderDatetime);
        $itemId = ItemId::gen();
        $orderDetail = OrderDetail::create($itemId, -1);

        // when:

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("商品の発注数の合計は0以上になるようにしてください。商品ID: $itemId->value");
        $order->addDetail($orderDetail);
    }
}
