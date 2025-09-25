<?php

declare(strict_types=1);

namespace Modules\Activity\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Organization\Model\Organization;

/**
 * @property int $id
 * @property string $name
 * @property ?int $parent_id
 * @property Collection $children
 *
 * @method static Builder inRandomOrder()
 */
class Activity extends Model
{
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function getAllDescendantIds(): array
    {
        $ids = [$this->id];

        foreach ($this->children as $child) {
            $ids = array_merge($child->getAllDescendantIds(), $ids);
        }
        return $ids;
    }
}