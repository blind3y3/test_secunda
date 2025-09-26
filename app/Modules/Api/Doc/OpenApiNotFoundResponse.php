<?php

declare(strict_types=1);

namespace Modules\Api\Doc;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'NotFoundResponse',
    title: 'Not Found',
    properties: [
        new OA\Property(property: 'message', type: 'string', nullable: false),
        new OA\Property(property: 'file', type: 'string', nullable: false),
        new OA\Property(property: 'line', type: 'integer', nullable: false),
    ],
    type: 'object',
)]
class OpenApiNotFoundResponse {}