<?php

declare(strict_types=1);

namespace Modules\Organization\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Organization\Exception\OrganizationNotFoundException;
use Modules\Organization\Model\Organization;

class OrganizationService implements OrganizationServiceInterface
{
    public function getAll(int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        return Organization::query()->paginate($perPage);
    }

    public function getByAddress(string $address, int $perPage = 20): LengthAwarePaginator
    {
        $organizations = Organization::query()
            ->select('organizations.*')
            ->join('buildings', 'organizations.building_id', '=', 'buildings.id')
            ->whereLike('buildings.address', sprintf('%%%s%%', $address));

        return $organizations->paginate($perPage);
    }

    public function getByActivity(string $activity, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::query()
            ->select('organizations.*')
            ->join('activity_organization', 'organizations.id', '=', 'activity_organization.organization_id')
            ->join('activities', 'activity_organization.activity_id', '=', 'activities.id')
            ->whereLike('activities.name', sprintf('%%%s%%', $activity));

        return $organizations->paginate($perPage);
    }

    public function getByActivityIds(array $ids, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::query()
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
        return Organization::query()->find($id) ?? throw new OrganizationNotFoundException();
    }

    public function getByName(string $name, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        return Organization::query()->whereLike('name', sprintf('%%%s%%', $name))->paginate($perPage);
    }
}