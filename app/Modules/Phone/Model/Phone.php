<?php

declare(strict_types=1);

namespace Modules\Phone\Model;

use Database\Factories\PhoneFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
    ];

    protected static function newFactory(): PhoneFactory
    {
        return PhoneFactory::new();
    }
}