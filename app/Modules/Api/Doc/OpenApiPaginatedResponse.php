<?php

declare(strict_types=1);

namespace Modules\Api\Doc;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PaginatedResponse',
    title: 'Paginated response',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(),
        ),
        new OA\Property(
            property: 'links',
            properties: [
                new OA\Property(property: 'first', type: 'string', nullable: true),
                new OA\Property(property: 'last', type: 'string', nullable: true),
                new OA\Property(property: 'prev', type: 'string', nullable: true),
                new OA\Property(property: 'next', type: 'string', nullable: true),
            ],
            type: 'object',
        ),
        new OA\Property(
            property: 'meta',
            properties: [
                new OA\Property(property: 'current_page', type: 'integer'),
                new OA\Property(property: 'from', type: 'integer', nullable: true),
                new OA\Property(property: 'last_page', type: 'integer'),
                new OA\Property(property: 'path', type: 'string'),
                new OA\Property(property: 'per_page', type: 'integer'),
                new OA\Property(property: 'to', type: 'integer', nullable: true),
                new OA\Property(property: 'total', type: 'integer'),
                new OA\Property(
                    property: 'links',
                    properties: [
                        new OA\Property(property: 'url', type: 'string', nullable: true),
                        new OA\Property(property: 'label', type: 'string', nullable: false),
                        new OA\Property(property: 'page', type: 'integer', nullable: true),
                        new OA\Property(property: 'active', type: 'bool', nullable: false),
                    ],
                    type: 'object',
                ),
            ],
            type: 'object',
        ),
    ],
    type: 'object',
)]
class OpenApiPaginatedResponse {}