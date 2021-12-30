<?php

namespace Delivery\Infra\Tests\DataCreators;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Entity\Store\Store;
use Delivery\Infra\Models\Hub;
use Delivery\Infra\Models\Store as StoreModel;

class StoreDataCreator
{
    public function create(
        Name $name,
        string $phoneNumber = "090-1234-5678",
        string $basicInformation = "店舗基本情報"
    ): Store {
        $store = Store::create(
            name: $name,
            phoneNumber: $phoneNumber,
            basicInformation: $basicInformation
        );
        Hub::factory()->create(
            [
                'hub_id' => $store->storeId->value,
                'name' => $store->name->value,
                'phone_number' => $store->phoneNumber
            ]
        );
        StoreModel::factory()->create(
            [
                'hub_id' => $store->storeId->value,
                'basic_information' => $store->basicInformation,
                'route_code' => null,
                'delivery_order' => null
            ]
        );
        return $store;
    }
}
