<?php

use App\Controllers\NewsController;
use App\Kernel\Router\Route;

return [
    Route::get('/', [NewsController::class, 'index']),
    Route::get('/create', [NewsController::class, 'create']),
    Route::get('/show', [NewsController::class, 'show']),
    Route::get('/edit', [NewsController::class, 'edit']),
    Route::post('/create', [NewsController::class, 'store']),
    Route::post('/destroy', [NewsController::class, 'delete']),
    Route::post('/show', [NewsController::class, 'delete']),
    Route::post('/edit', [NewsController::class, 'update']),
];