<?php

namespace Delivery\Infra\Tests\Unit\Eloquent\Order;

use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\Repositories\Item\ItemEloquentRepository;
use Delivery\Infra\Repositories\Order\OrderEloquentRepository;
use Delivery\Infra\Tests\DataCreators\ItemDataCreator;
use Delivery\Infra\Tests\DataCreators\OrderDataCreator;
use Delivery\Infra\Tests\DataCreators\OrderDetailDataCreator;
use Delivery\Infra\Tests\DataCreators\StoreDataCreator;
use Delivery\Infra\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderEloquentRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private OrderDataCreator $orderDataCreator;
    private OrderDetailDataCreator $orderDetailDataCreator;
    private StoreDataCreator $storeDataCreator;
    private ItemDataCreator $itemDataCreator;

    private OrderEloquentRepository $repository;

    public function setUp(): void
    {
        $this->orderDataCreator = new OrderDataCreator();
        $this->orderDetailDataCreator = new OrderDetailDataCreator();
        $this->storeDataCreator = new StoreDataCreator();
        $this->itemDataCreator = new ItemDataCreator();

        $this->repository = new OrderEloquentRepository();

        parent::setUp();
    }

    public function test_Orderの配列を全て取得できること(): void
    {
        // given:
        $store1 = $this->storeDataCreator->create(Name::of('store1 name'));
        $item1 = $this->itemDataCreator->create(Name::of('item1 name'), 100);
        $item2 = $this->itemDataCreator->create(Name::of('item2 name'), 0);

        $order1 = $this->orderDataCreator->create($store1, DateTime::fromString('2021-01-01'));
        $order2 = $this->orderDataCreator->create($store1, DateTime::fromString('2021-01-01'));

        $orderDetail1 = $this->orderDetailDataCreator->create($order2, $item1);
        $orderDetail2 = $this->orderDetailDataCreator->create($order2, $item2);

        $order2WithDetails = $order2->addDetail($orderDetail1)->addDetail($orderDetail2);

        // when:
        $result = $this->repository->list();

        // then:
        $expected = [$order1, $order2WithDetails];

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[1], $result[1]);
        $this->assertEquals($orderDetail1, $result[1]->orderDetails[0]);
        $this->assertEquals($orderDetail2, $result[1]->orderDetails[1]);
    }
}
