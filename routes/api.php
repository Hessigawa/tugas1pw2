<?php

use App\Http\Controllers\EventController;
use Illuminate\Routing\Route;

Route::get('event', [EventController::class, 'index']);
Route::post('event', [EventController::class, 'store']);
Route::patch('event/{id}', [EventController::class, 'update']);
Route::delete('event/{id}', [EventController::class, 'destroy']);

Route::get('ticket', [EventController::class, 'index']);
Route::post('ticket', [EventController::class, 'store']);
Route::patch('ticket/{id}', [EventController::class, 'update']);
Route::delete('ticket/{id}', [EventController::class, 'destroy']);