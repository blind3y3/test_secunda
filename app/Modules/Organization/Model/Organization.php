<?php

declare(strict_types=1);

namespace Modules\Organization\Model;

use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Activity\Model\Activity;
use Modules\Building\Model\Building;
use Modules\Phone\Model\Phone;

/**
 * @property int $id
 * @property string $name
 */
class Organization extends Model
{
    use HasFactory;

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
