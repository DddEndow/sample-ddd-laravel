<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Store;

class Store
{
    private function __construct(
        public readonly StoreId $storeId,
        public readonly string $name,
        public readonly string $phoneNumber,
        public readonly string $basicInformation,
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        string $name,
        string $phoneNumber,
        string $basicInformation
    ): Store {
        return new Store(
            storeId: StoreId::gen(),
            name: $name,
            phoneNumber: $phoneNumber,
            basicInformation: $basicInformation
        );
    }

    static public function reconstruct(
        string $storeId,
        string $name,
        string $phoneNumber,
        string $basicInformation
    ): Store {
        return new Store(
            storeId: StoreId::from($storeId),
            name: $name,
            phoneNumber: $phoneNumber,
            basicInformation: $basicInformation
        );
    }
}
