<?php

namespace Modules\Building\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Building\Dto\GeoSearchDto;
use Modules\Building\Dto\SquareSearchDto;

interface BuildingServiceInterface
{
    public function searchInRadius(GeoSearchDto $dto, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;

    public function searchInSquare(SquareSearchDto $dto, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;
}