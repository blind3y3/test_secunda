<?php

declare(strict_types=1);

namespace Modules\Building\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Building\Dto\GeoSearchDto;
use Modules\Building\Dto\SquareSearchDto;
use Modules\Building\Model\Building;

class BuildingService implements BuildingServiceInterface
{
    /**
     * Формула гаверсинуса (Haversine) для расчёта расстояния между координатами на сфере (Земле).
     * Радиус задается в метрах.
     */
    public function searchInRadius(GeoSearchDto $dto, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $query = Building::query()
            ->withWhereHas('organizations', function ($query) {
                $query->with(['phones', 'activities']);
            })
            ->select('buildings.*')
            ->selectRaw(
                <<<SQL
                (
                   6371000 * 2 * 
                    ASIN(
                        SQRT(
                            POWER(SIN( (latitude - ?) * PI() / 180 / 2), 2) +
                            COS(latitude * PI() / 180) *
                            COS(? * PI() / 180) *
                            POWER(SIN( (longitude - ?) * PI() / 180 / 2), 2)
                        )
                  )
                ) AS distance 
                SQL,
                [$dto->getLatitude(), $dto->getLatitude(), $dto->getLongitude()]

            )
            ->having('distance', '<=', $dto->getRadius())
            ->orderBy('distance');

        return $query->paginate($perPage);
    }

    public function searchInSquare(SquareSearchDto $dto, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $query = Building::query()
            ->withWhereHas('organizations', function ($query) {
                $query->with(['phones', 'activities']);
            })
            ->whereBetween('latitude', [$dto->getLatMin(), $dto->getLatMax()])
            ->whereBetween('longitude', [$dto->getLngMin(), $dto->getLngMax()]);

        return $query->paginate($perPage);
    }
}