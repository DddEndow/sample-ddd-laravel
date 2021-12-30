<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Store;

use Delivery\Domain\Entity\Shared\Name;

class Store
{
    private function __construct(
        public readonly StoreId $storeId,
        public readonly Name $name,
        public readonly string $phoneNumber,
        public readonly string $basicInformation,
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        Name $name,
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
        StoreId $storeId,
        Name $name,
        string $phoneNumber,
        string $basicInformation
    ): Store {
        return new Store(
            storeId: $storeId,
            name: $name,
            phoneNumber: $phoneNumber,
            basicInformation: $basicInformation
        );
    }
}
