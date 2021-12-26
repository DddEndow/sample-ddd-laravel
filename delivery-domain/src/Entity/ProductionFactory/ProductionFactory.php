<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\ProductionFactory;

class ProductionFactory
{
    private function __construct(
        public readonly ProductionFactoryId $productionFactoryId,
        public readonly string $name,
        public readonly string $phoneNumber,
        public readonly int $capacity
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        string $name,
        string $phoneNumber,
        int $capacity
    ): ProductionFactory {
        return new ProductionFactory(
            productionFactoryId: ProductionFactoryId::gen(),
            name: $name,
            phoneNumber: $phoneNumber,
            capacity: $capacity
        );
    }

    static public function reconstruct(
        string $productionFactoryId,
        string $name,
        string $phoneNumber,
        int $capacity
    ): ProductionFactory {
        return new ProductionFactory(
            productionFactoryId: ProductionFactoryId::from($productionFactoryId),
            name: $name,
            phoneNumber: $phoneNumber,
            capacity: $capacity
        );
    }
}
