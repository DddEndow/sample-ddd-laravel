<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Delivery;

use Delivery\Domain\Entity\Shared\DateTime;
use Delivery\Domain\Entity\Store\StoreId;

class Delivery
{
    private function __construct(
        public readonly DeliveryId $deliveryId,
        public readonly StoreId $deliveryStoreId,
        public readonly DateTime $scheduledDeliveryDatetime,
        public readonly ?DateTime $deliveryCompletionDatetime,
        /** @var DeliveryDetail[] */
        public readonly array $deliveryDetails
    ) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function create(
        StoreId $deliveryStoreId,
        DateTime $scheduledDeliveryDatetime,
        /** @var DeliveryDetail[] */
        array $deliveryDetails
    ): Delivery {
        return new Delivery(
            deliveryId: DeliveryId::gen(),
            deliveryStoreId: $deliveryStoreId,
            scheduledDeliveryDatetime: $scheduledDeliveryDatetime,
            deliveryCompletionDatetime: null,
            deliveryDetails: $deliveryDetails
        );
    }

    static public function reconstruct(
        string $deliveryId,
        string $deliveryStoreId,
        DateTime $scheduledDeliveryDatetime,
        ?DateTime $deliveryCompletionDatetime,
        /** @var DeliveryDetail[] */
        array $deliveryDetails
    ): Delivery {
        return new Delivery(
            deliveryId: DeliveryId::from($deliveryId),
            deliveryStoreId: StoreId::from($deliveryStoreId),
            scheduledDeliveryDatetime: $scheduledDeliveryDatetime,
            deliveryCompletionDatetime: $deliveryCompletionDatetime,
            deliveryDetails: $deliveryDetails
        );
    }
}
