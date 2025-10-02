<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Routing\Route;

Route::get('event', [EventController::class, 'index']);
Route::post('event', [EventController::class, 'store']);
Route::patch('event/{id}', [EventController::class, 'update']);
Route::delete('event/{id}', [EventController::class, 'destroy']);

Route::get('ticket', [TicketController::class, 'index']);
Route::post('ticket', [TicketController::class, 'store']);
Route::patch('ticket/{id}', [TicketController::class, 'update']);
Route::delete('ticket/{id}', [TicketController::class, 'destroy']);