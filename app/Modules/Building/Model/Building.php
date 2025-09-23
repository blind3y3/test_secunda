<?php

declare(strict_types=1);

namespace Modules\Building\Model;

use Database\Factories\BuildingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Organization\Model\Organization;

class Building extends Model
{
    use HasFactory;

    protected static function newFactory(): BuildingFactory
    {
        return BuildingFactory::new();
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}