<?php

namespace Modules\Organization\Service;

use Illuminate\Pagination\LengthAwarePaginator;

interface OrganizationServiceInterface
{
    public function getAll(int $perPage = 20): LengthAwarePaginator;

    public function getByAddress(string $address, int $perPage = 20): LengthAwarePaginator;
}