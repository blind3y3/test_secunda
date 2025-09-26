<?php

declare(strict_types=1);

namespace Modules\Organization\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Organization\Exception\OrganizationNotFoundException;
use Modules\Organization\Model\Organization;

class OrganizationService implements OrganizationServiceInterface
{
    public function getByAddress(string $address, int $perPage = 20): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->select('organizations.*')
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
            ->whereLike('buildings.address', sprintf('%%%s%%', $address));

        return $organizations->paginate($perPage);
    }

    public function getByActivity(string $activity, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->select('organizations.*')
            ->join('activity_organization', 'organizations.id', '=', 'activity_organization.organization_id')
            ->join('activities', 'activity_organization.activity_id', '=', 'activities.id')
            ->whereLike('activities.name', sprintf('%%%s%%', $activity));

        return $organizations->paginate($perPage);
    }

    public function getByActivityIds(array $ids, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->select('organizations.*', 'activity_organization.activity_id')
            ->join('activity_organization', 'organizations.id', '=', 'activity_organization.organization_id')
            ->whereIn('activity_organization.activity_id', $ids);

        return $organizations->paginate($perPage);
    }

    /**
     * @throws OrganizationNotFoundException
     */
    public function getById(int $id): Organization
    {
        return Organization::query()->where('id', $id)
            ->with([
                'building',
                'phones',
                'activities',
            ])->first() ?? throw new OrganizationNotFoundException();
    }

    public function getByName(string $name, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        return Organization::with(['building', 'phones', 'activities'])
            ->whereLike('name', sprintf('%%%s%%', $name))
            ->paginate($perPage);
    }
}