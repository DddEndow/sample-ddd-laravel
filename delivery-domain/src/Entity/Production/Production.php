<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Production;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactoryId;
use Delivery\Domain\Entity\Shared\DateTime;

class Production
{
    private function __construct(
        public readonly ProductionId $productionId,
        public readonly ProductionFactoryId $productionFactoryId,
        public readonly DateTime $scheduledCreationDatetime,
        public readonly ?DateTime $creationCompletionDatetime,
        /** @var ProductionDetail[] */
        public readonly array $productionDetails
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        ProductionFactoryId $productionFactoryId,
        DateTime $scheduledCreationDatetime,
        /** @var ProductionDetail[] */
        array $productionDetails
    ): Production {
        return new Production(
            productionId: ProductionId::gen(),
            productionFactoryId: $productionFactoryId,
            scheduledCreationDatetime: $scheduledCreationDatetime,
            creationCompletionDatetime: null,
            productionDetails: $productionDetails
        );
    }

    static public function reconstruct(
        string $productionId,
        string $productionFactoryId,
        DateTime $scheduledCreationDatetime,
        ?DateTime $creationCompletionDatetime,
        /** @var ProductionDetail[] */
        array $productionDetails
    ): Production {
        return new Production(
            productionId: ProductionId::from($productionId),
            productionFactoryId: ProductionFactoryId::from($productionFactoryId),
            scheduledCreationDatetime: $scheduledCreationDatetime,
            creationCompletionDatetime: $creationCompletionDatetime,
            productionDetails: $productionDetails
        );
    }
}
