<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Hub;

use Delivery\App\UseCases\Hub\HubType;
use Delivery\App\UseCases\Hub\ListHubsQueryService;
use Delivery\App\UseCases\Hub\ListHubsUseCase;
use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Entity\Store\Store;
use Delivery\Domain\Tests\TestDataFactories\TestStoreFactory;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListHubsUseCaseTest extends TestCase
{
    private TestStoreFactory $testStoreFactory;

    public function setUp(): void
    {
        $this->testStoreFactory = new TestStoreFactory();
        parent::setUp();
    }

    public function test_拠点一覧が取得できること(): void
    {
        // given:
        $productionFactory1 = ProductionFactory::create(Name::of('factory1 name'), '090-1234-5678', 100);
        $productionFactory2 = ProductionFactory::create(Name::of('factory1 name'), '090-1234-5678', 100);
        $store1 = Store::create(Name::of('store1 name'), '090-1234-5678', '店舗１');
        $store2 = $this->testStoreFactory->create(Name::of('store2 name'));

        $hubs = [
            $productionFactory1,
            $productionFactory2,
            $store1,
            $store2
        ];

        $listHubsQueryService = Mockery::mock(ListHubsQueryService::class);
        $listHubsQueryService->shouldReceive('list')
            ->once()
            ->andReturn($hubs);

        $useCase = new ListHubsUseCase($listHubsQueryService);

        // when:
        $result = $useCase->invoke();

        // then:

        $this->assertCount(count($hubs), $result->hubs);
        // productionFactory1
        $this->assertEquals($productionFactory1->productionFactoryId->value, $result->hubs[0]->hubId);
        $this->assertEquals($productionFactory1->name->value, $result->hubs[0]->name);
        $this->assertEquals($productionFactory1->phoneNumber, $result->hubs[0]->phoneNumber);
        $this->assertEquals(HubType::ProductionFactory, $result->hubs[0]->hubType);
        // productionFactory2
        $this->assertEquals($productionFactory2->productionFactoryId->value, $result->hubs[1]->hubId);
        $this->assertEquals($productionFactory2->name->value, $result->hubs[1]->name);
        $this->assertEquals($productionFactory2->phoneNumber, $result->hubs[1]->phoneNumber);
        $this->assertEquals(HubType::ProductionFactory, $result->hubs[1]->hubType);
        // store1
        $this->assertEquals($store1->storeId->value, $result->hubs[2]->hubId);
        $this->assertEquals($store1->name->value, $result->hubs[2]->name);
        $this->assertEquals($store1->phoneNumber, $result->hubs[2]->phoneNumber);
        $this->assertEquals(HubType::Store, $result->hubs[2]->hubType);
        // store2
        $this->assertEquals($store2->storeId->value, $result->hubs[3]->hubId);
        $this->assertEquals($store2->name->value, $result->hubs[3]->name);
        $this->assertEquals($store2->phoneNumber, $result->hubs[3]->phoneNumber);
        $this->assertEquals(HubType::Store, $result->hubs[3]->hubType);
    }
}
