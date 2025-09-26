<?php

declare(strict_types=1);

namespace Modules\Api\Resource\Building;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;


#[OA\Schema(
    schema: 'BuildingResource',
    title: 'Building',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'address', type: 'string'),
        new OA\Property(property: 'latitude', type: 'float'),
        new OA\Property(property: 'longitude', type: 'float'),
    ],
    type: 'object'
)]
/**
 * @property int $id
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 */
class BuildingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'address'   => $this->address,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}