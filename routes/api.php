<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::delete('/notes/{id}', [NoteController::class, 'destroy']);
    
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);
});
