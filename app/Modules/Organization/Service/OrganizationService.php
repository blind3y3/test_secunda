<?php

declare(strict_types=1);

namespace Modules\Organization\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Organization\Exception\OrganizationNotFoundException;
use Modules\Organization\Model\Organization;

class OrganizationService implements OrganizationServiceInterface
{
    public function getByAddress(string $address, int $perPage = 20): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->whereHas('building', fn(Builder $b) => $b->whereLike('address', "%$address%"));

        return $organizations->paginate($perPage);
    }

    public function getByActivity(string $activity, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->whereHas('activities', fn(Builder $b) => $b->whereLike('name', "%$activity%"));

        return $organizations->paginate($perPage);
    }

    public function getByActivityIds(array $ids, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator
    {
        $organizations = Organization::with(['building', 'phones', 'activities'])
            ->whereHas('activities', fn(Builder $b) => $b->whereIn('id', $ids));

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