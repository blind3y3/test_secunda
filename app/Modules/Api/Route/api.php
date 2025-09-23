<?php

use Modules\Api\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('organizations')->group(function () {
    Route::get('/', [OrganizationController::class, 'index']);
});