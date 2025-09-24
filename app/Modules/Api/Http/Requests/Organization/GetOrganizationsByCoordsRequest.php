<?php

namespace Modules\Api\Http\Requests\Organization;

use Modules\Api\Http\Requests\BaseApiRequest;
use Modules\Building\Dto\GeoSearchDto;

class GetOrganizationsByCoordsRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected $redirect = false;

    public function rules(): array
    {
        return [
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius'    => 'nullable|integer',
        ];
    }


    public function toDto(): GeoSearchDto
    {
        $data = $this->validated();

        return new GeoSearchDto(
            floatval($data['latitude']),
            floatval($data['longitude']),
            isset($data['radius']) ? intval($data['radius']) : 50000, //@TODO вынести в хелпер с константами
        );
    }
}
