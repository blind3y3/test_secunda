<?php

declare(strict_types=1);

namespace Modules\Api\Resource\Organization;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Api\Resource\Activity\ActivityResource;
use Modules\Api\Resource\Phone\PhoneResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'OrganizationForBuildingResource',
    title: 'Organization for building',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(
            property: 'phones',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/PhoneResource'),
        ),
        new OA\Property(
            property: 'activities',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ActivityResource'),
        ),
    ],
    type: 'object'
)]
/**
 * @property int $id
 * @property string $name
 */
class OrganizationForBuildingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'phones'     => PhoneResource::collection($this->whenLoaded('phones')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
        ];
    }
}