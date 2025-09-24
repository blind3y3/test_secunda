<?php

declare(strict_types=1);

namespace Modules\Organization\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Modules\Organization\Service\OrganizationService;
use Modules\Organization\Service\OrganizationServiceInterface;

class OrganizationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrganizationServiceInterface::class, OrganizationService::class);
    }
}