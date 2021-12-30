<?php

declare(strict_types=1);

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use Delivery\App\UseCases\Hub\ListHubsDto;
use Delivery\App\UseCases\Hub\ListHubsUseCase;

class HubController extends Controller
{
    public function index(ListHubsUseCase $useCase): ListHubsDto
    {
        return $useCase->invoke();
    }
}
