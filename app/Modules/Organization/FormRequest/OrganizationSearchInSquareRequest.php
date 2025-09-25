<?php

namespace Modules\Organization\FormRequest;

use Modules\Api\Http\Requests\BaseApiRequest;
use Modules\Building\Dto\SquareSearchDto;

/**
 * @property string $latMin
 * @property string $latMax
 * @property string $lngMin
 * @property string $lngMax
 */
class OrganizationSearchInSquareRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'latMin' => 'required|numeric|between:-90,90',
            'latMax' => 'required|numeric|between:-90,90|gte:latMin',
            'lngMin' => 'required|numeric|between:-180,180',
            'lngMax' => 'required|numeric|between:-180,180|gte:lngMin',
        ];
    }

    protected function passedValidation(): void
    {
        $this->replace([
            'latMin' => (float)$this->latMin,
            'latMax' => (float)$this->latMax,
            'lngMin' => (float)$this->lngMin,
            'lngMax' => (float)$this->lngMax,
        ]);
    }


    public function toDto(): SquareSearchDto
    {
        $this->validated();
        $data = $this->toArray();

        return new SquareSearchDto(
            $data['latMin'],
            $data['latMax'],
            $data['lngMin'],
            $data['lngMax']
        );
    }

    public function messages(): array
    {
        return [
            'latMax.gte' => 'Максимальная широта должна быть >= минимальной',
            'lngMax.gte' => 'Максимальная долгота должна быть >= минимальной',
        ];
    }
}
