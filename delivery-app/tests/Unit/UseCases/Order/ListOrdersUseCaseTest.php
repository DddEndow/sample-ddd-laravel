<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Order;

use Delivery\App\UseCases\Order\ListOrdersUseCase;
use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Order\OrderDetail;
use Delivery\Domain\Entity\Order\OrderRepository;
use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListOrdersUseCaseTest extends TestCase
{
    public function test_発注一覧が取得できること(): void
    {
        // given:
        $storeId = StoreId::gen();
        $item1Id = ItemId::gen();
        $item2Id = ItemId::gen();

        $order1 = Order::create($storeId, DateTime::fromString('2021-01-01'));
        $order2 = Order::create($storeId, DateTime::fromString('2021-01-01'));

        $orderDetail1 = OrderDetail::create($item1Id, 100);
        $orderDetail2 = OrderDetail::create($item2Id, 1);

        $order2WithDetails = $order2->addDetail($orderDetail1)->addDetail($orderDetail2);

        $orders = [$order1, $order2WithDetails];

        $orderRepository = Mockery::mock(OrderRepository::class);
        $orderRepository->shouldReceive('list')
            ->once()
            ->andReturn($orders);

        $useCase = new ListOrdersUseCase($orderRepository);

        // when:
        $result = $useCase->invoke();

        // then:
        $expected = $orders;

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[1], $result[1]);
        $this->assertEquals($orderDetail1, $result[1]->orderDetails[0]);
        $this->assertEquals($orderDetail2, $result[1]->orderDetails[1]);
    }
}
