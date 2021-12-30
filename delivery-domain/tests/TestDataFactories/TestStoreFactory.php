<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\TestDataFactories;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Entity\Store\Store;

class TestStoreFactory
{
    public function create(
        Name $name,
        string $phoneNumber = "090-1234-5678",
        string $basicInformation = "店舗基本情報"
    ): Store {
        return Store::create(
            name: $name,
            phoneNumber: $phoneNumber,
            basicInformation: $basicInformation
        );
    }
}
