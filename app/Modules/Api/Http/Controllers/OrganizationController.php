<?php

declare(strict_types=1);

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Activity\Service\ActivityServiceInterface;
use Modules\Api\Resource\Organization\OrganizationResource;
use Modules\Organization\FormRequest\OrganizationSearchRequest;
use Modules\Organization\Service\OrganizationServiceInterface;
use OpenApi\Attributes as OA;

readonly class OrganizationController
{
    public function __construct(
        private OrganizationServiceInterface $organizationService,
        private ActivityServiceInterface $activityService,
    ) {
    }

    #[OA\Get(
        path: '/api/organizations/search-by-address',
        summary: 'Список всех организаций, находящихся в конкретном здании',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список организаций с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/OrganizationResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchByAddress(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByAddress($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }

    #[OA\Get(
        path: '/api/organizations/search-by-activity',
        summary: 'Список всех организаций, которые относятся к указанному виду деятельности',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список организаций с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/OrganizationResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchByActivity(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByActivity($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }

    #[OA\Get(
        path: '/api/organizations/search-by-activity-group',
        summary: 'Поиск организаций по основному и дочерним (при наличии) видам деятельности',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список организаций с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/OrganizationResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchByActivityGroup(OrganizationSearchRequest $request): ResourceCollection
    {
        $activityIds = $this->activityService->getCurrentAndDescendIdsByName($request->extractSearchQuery());
        $organizations = $this->organizationService->getByActivityIds($activityIds);

        return OrganizationResource::collection($organizations);
    }

    #[OA\Get(
        path: '/api/organizations/{id}',
        summary: 'Вывод информации об организации по её идентификатору',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Возвращает найденную организацию',
                content: new OA\JsonContent(ref: '#/components/schemas/OrganizationResource'),
            ),
            new OA\Response(
                response: '404', description: 'Организация не найдена',
                content: new OA\JsonContent(ref: '#/components/schemas/NotFoundResponse'),
            ),
        ]
    )]
    public function getById(int $id): OrganizationResource
    {
        $organization = $this->organizationService->getById($id);

        return OrganizationResource::make($organization);
    }

    #[OA\Get(
        path: '/api/organizations/search-by-name',
        summary: 'Поиск организации по названию',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список организаций с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/OrganizationResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchByName(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByName($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }
}