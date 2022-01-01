<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\Entity\Order;

use Delivery\Domain\Entity\Order\Order;
use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;
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
}
