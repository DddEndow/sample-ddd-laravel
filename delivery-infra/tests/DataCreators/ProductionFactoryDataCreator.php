<?php

namespace Delivery\Infra\Tests\DataCreators;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Infra\Models\Hub as HubModel;
use Delivery\Infra\Models\ProductionFactory as ProductionFactoryModel;

class ProductionFactoryDataCreator
{
    public function create(
        Name $name,
        string $phoneNumber = "090-1234-5678",
        int $capacity = 100
    ): ProductionFactory {
        $productionFactory = ProductionFactory::create(
            name: $name,
            phoneNumber: $phoneNumber,
            capacity: $capacity
        );
        HubModel::factory()->create(
            [
                'hub_id' => $productionFactory->productionFactoryId->value,
                'name' => $productionFactory->name->value,
                'phone_number' => $productionFactory->phoneNumber
            ]
        );
        ProductionFactoryModel::factory()->create(
            [
                'hub_id' => $productionFactory->productionFactoryId->value,
                'capacity' => $productionFactory->capacity,
            ]
        );
        return $productionFactory;
    }
}
