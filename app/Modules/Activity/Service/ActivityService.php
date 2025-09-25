<?php

declare(strict_types=1);

namespace Modules\Activity\Service;

use Modules\Activity\Model\Activity;

class ActivityService implements ActivityServiceInterface
{
    public function getCurrentAndDescendIdsByName(string $name): array
    {
        $rootActivity = Activity::query()->where('name', $name)->firstOrFail();

        return $rootActivity->getAllDescendantIds();
    }
}