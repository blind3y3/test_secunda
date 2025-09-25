<?php

namespace Modules\Organization\FormRequest;

use Modules\Api\Http\Requests\BaseApiRequest;

/**
 * @property string $search
 */
class OrganizationSearchRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'search' => 'required',
        ];
    }

    public function extractSearchQuery(): string
    {
        return $this->validated(['search']);
    }
}
