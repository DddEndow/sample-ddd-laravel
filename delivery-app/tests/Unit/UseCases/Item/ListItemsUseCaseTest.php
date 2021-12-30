<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Item;

use Delivery\App\UseCases\Item\ListItemsUseCase;
use Delivery\Domain\Entity\Item\Item;
use Delivery\Domain\Entity\Item\ItemRepository;
use Delivery\Domain\Entity\Shared\Name;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListItemsUseCaseTest extends TestCase
{
    public function test_商品一覧が取得できること(): void
    {
        // given:
        $items = [
            Item::create(Name::of('item1 name'), 100),
            Item::create(Name::of('item2 name'), 100)
        ];

        $itemRepository = Mockery::mock(ItemRepository::class);
        $itemRepository->shouldReceive('list')
            ->once()
            ->andReturn($items);

        $useCase = new ListItemsUseCase($itemRepository);

        // when:
        $result = $useCase->invoke();

        // then:
        $expected = $items;

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[1], $result[1]);
    }
}
