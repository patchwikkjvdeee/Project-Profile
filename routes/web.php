<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index']);
Route::get('/about', [ProfileController::class, 'about']);
Route::get('/spotlight', [ProfileController::class, 'spotlight']);

Route::get('/profiles/create', [ProfileController::class, 'create']);
Route::post('/profiles', [ProfileController::class, 'store']);
Route::get('/profiles/{id}', [ProfileController::class, 'show']);
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit']);
Route::post('/profiles/{id}', [ProfileController::class, 'update']);
Route::post('/profiles/{id}/delete', [ProfileController::class, 'destroy']);