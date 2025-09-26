<?php

declare(strict_types=1);

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Api\Resource\Building\BuildingListResource;
use Modules\Building\Service\BuildingServiceInterface;
use Modules\Organization\FormRequest\OrganizationSearchInRadiusRequest;
use Modules\Organization\FormRequest\OrganizationSearchInSquareRequest;
use OpenApi\Attributes as OA;

readonly class BuildingController
{
    public function __construct(
        private BuildingServiceInterface $buildingService,
    ) {
    }

    #[OA\Get(
        path: '/api/buildings/search-in-radius',
        summary: 'Список зданий, которые находятся в заданном радиусе',
        tags: ['Buildings'],
        parameters: [
            new OA\Parameter(name: 'latitude', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'longitude', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'radius', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список зданий с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/BuildingListResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchInRadius(OrganizationSearchInRadiusRequest $request): ResourceCollection
    {
        $dto = $request->toDto();
        $buildings = $this->buildingService->searchInRadius($dto);

        return BuildingListResource::collection($buildings);
    }

    #[OA\Get(
        path: '/api/buildings/search-in-square',
        summary: 'Список зданий, которые находятся в заданной прямоугольной области',
        tags: ['Buildings'],
        parameters: [
            new OA\Parameter(name: 'latMin', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'latMax', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'lngMin', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'lngMax', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: '200',
                description: 'Список зданий с пагинацией',
                content: new OA\JsonContent(
                    allOf: [
                        new OA\Schema(ref: '#/components/schemas/PaginatedResponse', type: 'object'),
                        new OA\Schema(
                            properties: [
                                new OA\Property(
                                    property: 'data',
                                    type: 'array',
                                    items: new OA\Items(ref: '#/components/schemas/BuildingListResource'),
                                )
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function searchInSquare(OrganizationSearchInSquareRequest $request): ResourceCollection
    {
        $dto = $request->toDto();
        $buildings = $this->buildingService->searchInSquare($dto);

        return BuildingListResource::collection($buildings);
    }
}