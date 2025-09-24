<?php

declare(strict_types=1);

namespace Modules\Building\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Building\Dto\GeoSearchDto;
use Modules\Building\Model\Building;

class BuildingService implements BuildingServiceInterface
{
    public function getAllWithOrganizations(int $perPage = 20): LengthAwarePaginator
    {
        return Building::with('organizations')->paginate($perPage);
    }

    /**
     * Формула гаверсинуса (Haversine) для расчёта расстояния между координатами на сфере (Земле).
     * Радиус задается в метрах.
     */
    public function getByCoords(GeoSearchDto $dto, int $perPage = 20): LengthAwarePaginator
    {
        $query = Building::with('organizations')
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
}