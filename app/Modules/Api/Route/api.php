<?php

use Modules\Api\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('organizations')->middleware(['api'])->group(function () {
    Route::get('by-address/{address}', [OrganizationController::class, 'getByAddress']);
    Route::get('by-building', [OrganizationController::class, 'listByBuilding']);
    Route::get('by-coords', [OrganizationController::class, 'getByCoords']);
});