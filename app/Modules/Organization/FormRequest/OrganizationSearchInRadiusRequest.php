<?php

namespace Modules\Organization\FormRequest;

use App\DataKeepers\BaseDataKeeper;
use Modules\Api\Http\Requests\BaseApiRequest;
use Modules\Building\Dto\GeoSearchDto;

/**
 * @property string $latitude
 * @property string $longitude
 * @property ?string $radius
 */
class OrganizationSearchInRadiusRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius'    => 'nullable|integer',
        ];
    }

    protected function passedValidation(): void
    {
        $this->replace([
            'latitude'  => (float)$this->latitude,
            'longitude' => (float)$this->longitude,
            'radius'    => $this->radius !== null ? (int)$this->radius : BaseDataKeeper::RADIUS,
        ]);
    }


    public function toDto(): GeoSearchDto
    {
        $this->validated();
        $data = $this->toArray();

        return new GeoSearchDto(
            $data['latitude'],
            $data['longitude'],
            $data['radius']
        );
    }
}
