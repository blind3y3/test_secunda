<?php

declare(strict_types=1);

namespace Modules\Api\Resource\Activity;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ActivityResource',
    title: 'Activity',
    properties: [
        new OA\Property(property: 'name', type: 'string'),
    ],
    type: 'object'
)]
/**
 * @property string $name
 */
class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}