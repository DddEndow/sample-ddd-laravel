<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\ProductionFactory;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Exceptions\DomainException;

class ProductionFactory
{
    private const MAX_CAPACITY = 100000;

    private function __construct(
        public readonly ProductionFactoryId $productionFactoryId,
        public readonly Name $name,
        public readonly string $phoneNumber,
        public readonly int $capacity
    ) {
        $this->validateCapacity($this->capacity);
    }

    // -------- private functions --------

    private function validateCapacity(int $capacity): void
    {
        if ($capacity < 0) throw new DomainException("生産能力は0以上の値を入力してください。");
        if ($capacity > self::MAX_CAPACITY) throw new DomainException("生産能力は100,000を超えないようにしてください。");
    }

    // -------- static functions --------

    static public function create(
        Name $name,
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
        ProductionFactoryId $productionFactoryId,
        Name $name,
        string $phoneNumber,
        int $capacity
    ): ProductionFactory {
        return new ProductionFactory(
            productionFactoryId: $productionFactoryId,
            name: $name,
            phoneNumber: $phoneNumber,
            capacity: $capacity
        );
    }
}
