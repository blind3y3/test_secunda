<?php

declare(strict_types=1);

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Api\Http\Requests\Organization\GetOrganizationsByCoordsRequest;
use Modules\Api\Resource\Building\BuildingListResource;
use Modules\Api\Resource\Organization\OrganizationListResource;
use Modules\Building\Service\BuildingServiceInterface;
use Modules\Organization\Service\OrganizationServiceInterface;

readonly class OrganizationController
{
    public function __construct(
        private OrganizationServiceInterface $organizationService,
        private BuildingServiceInterface $buildingService,
    ) {
    }

    public function getByAddress(string $address): ResourceCollection
    {
        $organizations = $this->organizationService->getByAddress($address);

        return OrganizationListResource::collection($organizations);
    }

    public function listByBuilding(): ResourceCollection
    {
        $data = $this->buildingService->getAllWithOrganizations();

        return BuildingListResource::collection($data);
    }

    public function getByCoords(GetOrganizationsByCoordsRequest $request): ResourceCollection
    {
        $dto = $request->toDto();
        $data = $this->buildingService->getByCoords($dto);

        return BuildingListResource::collection($data);
    }
}