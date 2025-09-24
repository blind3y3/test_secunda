<?php

use Modules\Building\ServiceProvider\BuildingServiceProvider;
use Modules\Organization\ServiceProvider\OrganizationServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    OrganizationServiceProvider::class,
    BuildingServiceProvider::class,
];
