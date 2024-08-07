<?php

use Illuminate\Support\Facades\Route;
use AvrilloCodeTest\AuthToken\Http\Controllers\GenerateToken;

Route::middleware(['api'])->prefix('v1')->group(function () {
    Route::get('generate-token', GenerateToken::class);
});