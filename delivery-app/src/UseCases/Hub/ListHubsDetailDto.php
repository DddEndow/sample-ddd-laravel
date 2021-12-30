<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Hub;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Store\Store;
use Spatie\LaravelData\Data;

class ListHubsDetailDto extends Data
{
    public function __construct(
        public string $hubId,
        public string $name,
        public string $phoneNumber,
        public HubType $hubType
    ) {
    }

    /**
     * @param ProductionFactory|Store $hub
     * @return static
     */
    static public function of(ProductionFactory|Store $hub): self
    {
        if ($hub instanceof ProductionFactory) {
            return new self(
                hubId: $hub->productionFactoryId->value,
                name: $hub->name->value,
                phoneNumber: $hub->phoneNumber,
                hubType: HubType::ProductionFactory
            );
        } else { // Store
            return new self(
                hubId: $hub->storeId->value,
                name: $hub->name->value,
                phoneNumber: $hub->phoneNumber,
                hubType: HubType::Store
            );
        }
    }
}
