<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\UseCases\Store;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Entity\Store\Store;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase
{
    public function test_Storeを作成できること(): void
    {
        // given:
        $name = Name::of('production factory name');
        $phoneNumber = '090-1234-5678';
        $basicInformation = "地区Aの店舗です。";

        // when:
        $result = Store::create(name: $name, phoneNumber: $phoneNumber, basicInformation: $basicInformation);

        // then:
        $this->assertEquals($name, $result->name);
        $this->assertEquals($phoneNumber, $result->phoneNumber);
        $this->assertEquals($basicInformation, $result->basicInformation);
    }
}
