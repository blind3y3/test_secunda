<?php

declare(strict_types=1);

namespace Modules\Building\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Modules\Building\Service\BuildingService;
use Modules\Building\Service\BuildingServiceInterface;

class BuildingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BuildingServiceInterface::class, BuildingService::class);
    }
}