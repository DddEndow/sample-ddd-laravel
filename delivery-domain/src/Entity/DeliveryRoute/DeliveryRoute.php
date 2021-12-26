<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\DeliveryRoute;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactoryId;

class DeliveryRoute
{
    private function __construct(
        public readonly DeliveryRouteId $deliveryRouteId,
        public readonly string $name,
        public readonly ProductionFactoryId $productionFactoryId,
        /** @var DeliveryOrder[] */
        public readonly array $deliveryOrders
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        string $name,
        ProductionFactoryId $productionFactoryId,
        /** @var DeliveryOrder[] */
        array $deliveryOrders
    ): DeliveryRoute {
        return new DeliveryRoute(
            deliveryRouteId: DeliveryRouteId::gen(),
            name: $name,
            productionFactoryId: $productionFactoryId,
            deliveryOrders: $deliveryOrders
        );
    }

    static public function reconstruct(
        string $deliveryRouteId,
        string $name,
        string $productionFactoryId,
        /** @var DeliveryOrder[] */
        array $deliveryOrders
    ): DeliveryRoute {
        return new DeliveryRoute(
            deliveryRouteId: DeliveryRouteId::from($deliveryRouteId),
            name: $name,
            productionFactoryId: ProductionFactoryId::from($productionFactoryId),
            deliveryOrders: $deliveryOrders
        );
    }
}
