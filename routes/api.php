<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\CollectionController;

// Route bawaan Laravel
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes CRUD Media FlipPlay
Route::get('/media', [MediaController::class, 'index']);
Route::get('/media/{id}', [MediaController::class, 'show']);
Route::post('/media', [MediaController::class, 'store']);
Route::put('/media/{id}', [MediaController::class, 'update']);
Route::patch('/media/{id}', [MediaController::class, 'update']);
Route::delete('/media/{id}', [MediaController::class, 'destroy']);

// Routes Koleksi Pengguna FlipPlay
Route::get('/users/{userId}/collection', [CollectionController::class, 'index']);
Route::post('/users/{userId}/collection/{mediaId}', [CollectionController::class, 'attach']);
Route::delete('/users/{userId}/collection/{mediaId}', [CollectionController::class, 'detach']);
