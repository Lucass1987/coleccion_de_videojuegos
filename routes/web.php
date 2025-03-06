<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/token', [ApiController::class, 'token']);

Route::match(['get', 'post'],'/juegos/{id}', [GameController::class, 'show'])
    ->where('id', '[0-9]+');

Route::get('/juegos', [GameController::class, 'index']);

Route::get('/juegos/{id}/add', [GameController::class, 'add'])
    ->where('id', '[0-9]+')->name('collection.add');

Route::get('/juegos/{id}/remove', [GameController::class, 'remove'])
    ->where('id', '[0-9]+')->name('collection.remove');




