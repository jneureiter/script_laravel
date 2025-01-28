<?php

use App\Http\Controllers\RestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * REST - api.php
 */
Route::get('/notes', [RestController::class, 'index'])
    ->name('rest.index')
    ->middleware('auth:sanctum', 'abilities:notes:all');

Route::get('/notes/{id}', [RestController::class, 'show'])
    ->name('rest.show')
    ->middleware('auth:sanctum');
