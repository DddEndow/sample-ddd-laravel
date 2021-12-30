<?php

declare(strict_types=1);

namespace Delivery\App\UseCases\Hub;

class ListHubsUseCase
{
    public function __construct(
        private ListHubsQueryService $queryService
    ) {}

    /**
     * @return ListHubsDto
     */
    public function invoke(): ListHubsDto
    {
        return ListHubsDto::of($this->queryService->list());
    }
}
