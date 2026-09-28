<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'home']);
Route::get('/skills', [ProfileController::class, 'skills']);
Route::get('/contact', [ProfileController::class, 'contact']);
Route::get('/edit', [ProfileController::class, 'edit']);
Route::post('/edit', [ProfileController::class, 'save']);
Route::post('/reset', [ProfileController::class, 'reset']);
