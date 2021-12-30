<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Hub;

enum HubType: string
{
    case ProductionFactory = 'production_factory';
    case Store = 'store';
}
