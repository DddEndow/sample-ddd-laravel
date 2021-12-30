<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Hub;

use Delivery\Domain\Entity\ProductionFactory\ProductionFactory;
use Delivery\Domain\Entity\Store\Store;

interface ListHubsQueryService
{
    /**
     * @return array<ProductionFactory|Store>
     */
    public function list(): array;
}
