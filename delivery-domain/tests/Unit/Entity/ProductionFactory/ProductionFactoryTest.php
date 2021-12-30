<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\UseCases\ProductionFactory;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;

class ProductionFactoryTest extends TestCase
{
    public function test_ProductionFactoryを作成できること(): void
    {
        // given:
        $name = Name::of('production factory name');
        $phoneNumber = '090-1234-5678';
        $capacity = 100000;

        // when:
        $result = ProductionFactory::create(name: $name, phoneNumber: $phoneNumber, capacity: $capacity);

        // then:
        $this->assertEquals($name, $result->name);
        $this->assertEquals($phoneNumber, $result->phoneNumber);
        $this->assertEquals($capacity, $result->capacity);
    }

    public function test_capacityが10万を超える場合エラーになること(): void
    {
        // given:
        $name = Name::of('production factory name');
        $phoneNumber = '090-1234-5678';
        $capacity = 100001;

        // when:

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("生産能力は100,000を超えないようにしてください。");
        ProductionFactory::create(name: $name, phoneNumber: $phoneNumber, capacity: $capacity);
    }

    public function test_capacityが0未満の場合エラーになること(): void
    {
        // given:
        $name = Name::of('production factory name');
        $phoneNumber = '090-1234-5678';
        $capacity = -1;

        // when:

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("生産能力は0以上の値を入力してください。");
        ProductionFactory::create(name: $name, phoneNumber: $phoneNumber, capacity: $capacity);
    }
}
