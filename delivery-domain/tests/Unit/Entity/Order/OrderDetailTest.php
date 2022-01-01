<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\Entity\Order;

use Delivery\Domain\Entity\Item\ItemId;
use Delivery\Domain\Entity\Order\OrderDetail;
use PHPUnit\Framework\TestCase;

class OrderDetailTest extends TestCase
{
    public function test_OrderDetailを作成できること(): void
    {
        // given:
        $itemId = ItemId::gen();
        $quantity = 100;

        // when:
        $result = OrderDetail::create(
            itemId: $itemId,
            quantity: $quantity
        );

        // then:
        $this->assertEquals($itemId, $result->itemId);
        $this->assertEquals(null, $result->productionId);
        $this->assertEquals(null, $result->deliveryId);
        $this->assertEquals($quantity, $result->quantity);
    }
}
