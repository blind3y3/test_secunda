<?php

declare(strict_types=1);

namespace Modules\Organization\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Organization\Model\Organization;

class OrganizationService implements OrganizationServiceInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator
    {
        return Organization::query()->paginate($perPage);
    }

    public function getByAddress(string $address, int $perPage = 20): LengthAwarePaginator
    {
        $organizations = Organization::query()
            ->select('organizations.*')
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
            ->where('buildings.address', 'like', sprintf('%s%%', $address));

        return $organizations->paginate($perPage);
    }
}