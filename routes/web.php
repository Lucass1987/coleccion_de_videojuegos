<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/token', [ApiController::class, 'token']);

Route::get('/juegos/{id}', [GameController::class, 'show'])
    ->where('id', '[0-9]+')->name('show');

Route::post('/juegos/{id}', [GameController::class, 'update'])
    ->where('id', '[0-9]+');



Route::get('/juegos', [GameController::class, 'index']);






