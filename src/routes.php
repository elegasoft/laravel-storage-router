<?php

use Elegasoft\LaravelStorageRoute\Controllers\FallbackController;
use Illuminate\Support\Facades\Route;

Route::fallback(FallbackController::class);