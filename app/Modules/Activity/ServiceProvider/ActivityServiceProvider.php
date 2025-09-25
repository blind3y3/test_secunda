<?php

declare(strict_types=1);

namespace Modules\Activity\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Modules\Activity\Service\ActivityService;
use Modules\Activity\Service\ActivityServiceInterface;

class ActivityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ActivityServiceInterface::class, ActivityService::class);
    }
}