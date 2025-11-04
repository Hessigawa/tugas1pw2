<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('event', [EventController::class, 'index']);
Route::post('event', [EventController::class, 'store']);
Route::patch('event/{id}', [EventController::class, 'update']);
Route::delete('event/{id}', [EventController::class, 'destroy']);

Route::get('ticket', [TicketController::class, 'index']);
Route::post('ticket', [TicketController::class, 'store']);
Route::patch('ticket/{id}', [TicketController::class, 'update']);
Route::delete('ticket/{id}', [TicketController::class, 'destroy']);