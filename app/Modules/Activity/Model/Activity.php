<?php

declare(strict_types=1);

namespace Modules\Activity\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Organization\Model\Organization;

/**
 * @method static Builder inRandomOrder()
 */
class Activity extends Model
{
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
}