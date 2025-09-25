<?php

use Modules\Api\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('organizations')->middleware(['api'])->group(function () {
    Route::get('search-by-address', [OrganizationController::class, 'searchByAddress']);
    Route::get('search-by-activity', [OrganizationController::class, 'searchByActivity']);
    Route::get('search-by-activity-group', [OrganizationController::class, 'searchByActivityGroup']);
    Route::get('search-in-radius', [OrganizationController::class, 'searchInRadius']);
    Route::get('search-in-square', [OrganizationController::class, 'searchInSquare']);
    Route::get('{id}', [OrganizationController::class, 'getById'])->where(['id' => '[0-9]+']);
    Route::get('search-by-name', [OrganizationController::class, 'searchByName']);
});