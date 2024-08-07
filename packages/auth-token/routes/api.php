<?php

use Illuminate\Support\Facades\Route;
use AvrilloCodeTest\AuthToken\Http\Controllers\GenerateToken;

Route::middleware(['api'])->prefix('api')->group(function () {
    Route::get('generate-token', GenerateToken::class);
});