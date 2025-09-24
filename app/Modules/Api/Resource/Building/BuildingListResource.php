<?php

declare(strict_types=1);

namespace Modules\Api\Resource\Building;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Api\Resource\Organization\OrganizationListResource;

/**
 * @property int $id
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 */
class BuildingListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'address'       => $this->address,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'organizations' => OrganizationListResource::collection($this->whenLoaded('organizations')),
        ];
    }
}