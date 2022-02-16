<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;

Route::get('/', [PageController::class, 'home']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('repositories', RepositoryController::class)->middleware('auth:sanctum');
