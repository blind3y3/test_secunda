<?php

declare(strict_types=1);

namespace Modules\Api\Resource\Phone;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PhoneResource',
    title: 'Phone',
    properties: [
        new OA\Property(property: 'number', type: 'string'),
    ],
    type: 'object'
)]
/**
 * @property string $number
 */
class PhoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'number' => $this->number,
        ];
    }
}