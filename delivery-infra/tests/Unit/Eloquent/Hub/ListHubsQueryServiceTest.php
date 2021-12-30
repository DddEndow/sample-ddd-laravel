<?php

namespace Delivery\Infra\Tests\Unit\Eloquent\Hub;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\QueryServices\Hub\ListHubsEloquentQueryService;
use Delivery\Infra\Tests\DataCreators\ProductionFactoryDataCreator;
use Delivery\Infra\Tests\DataCreators\StoreDataCreator;
use Delivery\Infra\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListHubsQueryServiceTest extends TestCase
{
    use DatabaseTransactions;

    private ProductionFactoryDataCreator $productionFactoryDataCreator;
    private StoreDataCreator $storeDataCreator;
    private ListHubsEloquentQueryService $queryService;

    public function setUp(): void
    {
        $this->productionFactoryDataCreator = new ProductionFactoryDataCreator();
        $this->storeDataCreator = new StoreDataCreator();
        $this->queryService = new ListHubsEloquentQueryService();

        parent::setUp();
    }

    public function test_Hubの配列を全て取得できること(): void
    {
        // given:
        $productionFactory1 = $this->productionFactoryDataCreator->create(Name::of('factory1 name'));
        $productionFactory2 = $this->productionFactoryDataCreator->create(Name::of('factory2 name'));
        $productionFactory3 = $this->productionFactoryDataCreator->create(Name::of('factory3 name'));

        $store1 = $this->storeDataCreator->create(Name::of('store1 name'));
        $store2 = $this->storeDataCreator->create(Name::of('store2 name'));
        $store3 = $this->storeDataCreator->create(Name::of('store3 name'));

        // when:
        $result = $this->queryService->list();

        // then:
        $expected = [
            $productionFactory1,
            $productionFactory2,
            $productionFactory3,
            $store1,
            $store2,
            $store3
        ];

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[1], $result[1]);
        $this->assertEquals($expected[2], $result[2]);
        $this->assertEquals($expected[3], $result[3]);
        $this->assertEquals($expected[4], $result[4]);
        $this->assertEquals($expected[5], $result[5]);
    }
}
