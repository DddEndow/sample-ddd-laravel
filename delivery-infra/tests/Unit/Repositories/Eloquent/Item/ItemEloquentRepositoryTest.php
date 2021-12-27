<?php

namespace Delivery\Infra\Tests\Unit\Repsirotires\Eloquent\Item;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\Repositories\Item\ItemEloquentRepository;
use Delivery\Infra\Tests\DataCreators\ItemDataCreator;
use Delivery\Infra\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemEloquentRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private ItemDataCreator $itemDataCreator;
    private ItemEloquentRepository $repository;

    public function setUp(): void
    {
        $this->itemDataCreator = new ItemDataCreator();
        $this->repository = new ItemEloquentRepository();

        parent::setUp();
    }

    public function test_Itemの配列を全て取得できること(): void
    {
        // given:
        $item1 = $this->itemDataCreator->create(Name::of('item1 name'), 100);
        $item2 = $this->itemDataCreator->create(Name::of('item2 name'), 0);
        $item3 = $this->itemDataCreator->create(Name::of('item3 name'), 9999);

        // when:
        $result = $this->repository->list();

        // then:
        $expected = [$item1, $item2, $item3];

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[1], $result[1]);
        $this->assertEquals($expected[2], $result[2]);
    }
}
