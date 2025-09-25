<?php

declare(strict_types=1);

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Activity\Service\ActivityServiceInterface;
use Modules\Api\Resource\Building\BuildingListResource;
use Modules\Api\Resource\Organization\OrganizationResource;
use Modules\Building\Service\BuildingServiceInterface;
use Modules\Organization\FormRequest\OrganizationSearchInRadiusRequest;
use Modules\Organization\FormRequest\OrganizationSearchInSquareRequest;
use Modules\Organization\FormRequest\OrganizationSearchRequest;
use Modules\Organization\Service\OrganizationServiceInterface;

readonly class OrganizationController
{
    public function __construct(
        private OrganizationServiceInterface $organizationService,
        private BuildingServiceInterface $buildingService,
        private ActivityServiceInterface $activityService,
    ) {
    }

    /**
     * Список всех организаций, находящихся в конкретном здании
     */
    public function searchByAddress(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByAddress($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }

    /**
     * Список всех организаций, которые относятся к указанному виду деятельности
     */
    public function searchByActivity(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByActivity($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }

    /**
     * Поиск организаций по основному и дочерним, при наличии, видам деятельности
     */
    public function searchByActivityGroup(OrganizationSearchRequest $request): ResourceCollection
    {
        $activityIds = $this->activityService->getCurrentAndDescendIdsByName($request->extractSearchQuery());
        $organizations = $this->organizationService->getByActivityIds($activityIds);

        return OrganizationResource::collection($organizations);
    }

    /**
     * Список зданий, которые находятся в заданном радиусе
     */
    public function searchInRadius(OrganizationSearchInRadiusRequest $request): ResourceCollection
    {
        $dto = $request->toDto();
        $buildings = $this->buildingService->searchInRadius($dto);

        return BuildingListResource::collection($buildings);
    }

    /**
     * Список зданий, которые находятся в заданной прямоугольной области
     */
    public function searchInSquare(OrganizationSearchInSquareRequest $request): ResourceCollection
    {
        $dto = $request->toDto();
        $buildings = $this->buildingService->searchInSquare($dto);

        return BuildingListResource::collection($buildings);
    }

    /**
     * Вывод информации об организации по её идентификатору
     */
    public function getById(int $id): OrganizationResource
    {
        $organization = $this->organizationService->getById($id);

        return OrganizationResource::make($organization);
    }

    /**
     * Поиск организации по названию
     */
    public function searchByName(OrganizationSearchRequest $request): ResourceCollection
    {
        $organizations = $this->organizationService->getByName($request->extractSearchQuery());

        return OrganizationResource::collection($organizations);
    }
}