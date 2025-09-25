<?php

namespace Modules\Organization\Service;

use App\DataKeepers\BaseDataKeeper;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Organization\Model\Organization;

interface OrganizationServiceInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator;

    public function getByAddress(string $address, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;

    public function getByActivity(string $activity, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;

    public function getById(int $id): Organization;

    public function getByActivityIds(array $ids, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;

    public function getByName(string $name, int $perPage = BaseDataKeeper::PER_PAGE): LengthAwarePaginator;
}