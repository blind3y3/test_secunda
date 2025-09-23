<?php

declare(strict_types=1);

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Organization\Model\Organization;

class OrganizationController
{
    public function index(): JsonResponse
    {
        //@TODO для теста, потом переделать
        $organizations = Organization::all();

        return response()->json($organizations);
    }
}