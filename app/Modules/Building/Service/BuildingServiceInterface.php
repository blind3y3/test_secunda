<?php

namespace Modules\Building\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Building\Dto\GeoSearchDto;

interface BuildingServiceInterface
{
    public function getAllWithOrganizations(int $perPage = 20): LengthAwarePaginator;

    public function getByCoords(GeoSearchDto $dto, int $perPage = 20): LengthAwarePaginator;
}