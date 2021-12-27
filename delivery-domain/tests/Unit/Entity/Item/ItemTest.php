<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\UseCases\Item;

use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Shared\Name;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function test_Itemを作成できること(): void
    {
        // given:
        $name = Name::of('item name');
        $price = 100;

        // when:
        $result = Item::create(name: $name, price: $price);

        // then:
        $this->assertEquals($name, $result->name);
        $this->assertEquals($price, $result->price);
    }
}
