<?php

use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('template', ['view' => view('home')]);
});

Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbackController::class, 'get']);
    Route::get('/cadastrar', [FeedbackController::class, 'cadastrar']);
    Route::post('/insert', [FeedbackController::class, 'insert']);
    Route::post('/delete', [FeedbackController::class, 'delete']);
    Route::get('/excluir/{id}', [FeedbackController::class, 'excluir']);
});

Route::prefix('consultores')->group(function () {
    Route::get('/', [ConsultorController::class, 'index']);
    Route::get('/cadastrar', [ConsultorController::class, 'cadastrar']);
    Route::post('/insert', [ConsultorController::class, 'insert']);
    Route::post('/update', [ConsultorController::class, 'update']);
    Route::post('/delete', [ConsultorController::class, 'delete']);
});
