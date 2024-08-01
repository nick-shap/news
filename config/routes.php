<?php

use App\Controllers\NewsController;
use App\Kernel\Router\Route;

return [
    Route::get('/', [NewsController::class, 'index']),
    Route::get('/create', [NewsController::class, 'create']),
    Route::post('/create', [NewsController::class, 'store']),
];