<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuotesController;

Route::middleware(['authenticate'])->group(function() {
    Route::apiResource('quotes', QuotesController::class)->only(['index']);
});