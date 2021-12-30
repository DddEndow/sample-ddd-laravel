<?php

declare(strict_types=1);

namespace Delivery\Infra\QueryServices\Hub;

use Delivery\App\UseCases\Hub\ListHubsQueryService;
use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\ProductionFactory\ProductionFactoryId;
use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Entity\Store\Store;
use Delivery\Domain\Entity\Store\StoreId;
use Delivery\Infra\Models\Hub;

class ListHubsEloquentQueryService implements ListHubsQueryService
{
    /**
     * @return array<ProductionFactory|Store>
     * @throws \Exception
     */
    public function list(): array
    {
        return Hub::with(['productionFactory', 'store'])
            ->get()
            ->map(function (Hub $model): ProductionFactory|Store {
                if (!is_null($model->productionFactory)) {
                    return ProductionFactory::reconstruct(
                        productionFactoryId: ProductionFactoryId::from($model->productionFactory->hub_id),
                        name: Name::of($model->name),
                        phoneNumber: $model->phone_number,
                        capacity: $model->productionFactory->capacity
                    );
                } elseif (!is_null($model->store)) {
                    return Store::reconstruct(
                        storeId: StoreId::from($model->store->hub_id),
                        name: Name::of($model->name),
                        phoneNumber: $model->phone_number,
                        basicInformation: $model->store->basic_information
                    );
                } else {
                    throw new \Exception("productions_factoryにもstoreにも紐づいていない不正なデータです。hub_id: $model->hub_id");
                }
            })->all();
    }
}
