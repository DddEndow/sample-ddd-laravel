<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Hub;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Store\Store;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ListHubsDto extends Data
{
    public function __construct(
        /** @var ListHubsDetailDto[] */
        public DataCollection $hubs
    ) {
    }

    /**
     * @param array<ProductionFactory|Store> $hubs
     * @return static
     */
    static public function of(array $hubs): self
    {
        $details = ListHubsDetailDto::collection(
            array_map(fn(ProductionFactory|Store $hub): ListHubsDetailDto => ListHubsDetailDto::of($hub), $hubs)
        );
        return new self(
            hubs: $details
        );
    }
}
