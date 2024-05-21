<?php

use App\Http\Controllers\AdvertenciaController;
use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Models\AdvertenciaModel;
use App\Models\FeedbackModel;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', static function () {
    return view('template', ['view' => view('home', [
            'feedbacks' => FeedbackModel::getRecentes(),
            'advertencias' => AdvertenciaModel::getRecentes(),
        ]),
    ]);
})->middleware(['auth', 'verified'])->name('/');

Route::middleware('auth')->group(function () {


    Route::prefix('feedbacks')->group(function () {
        Route::get('/', [FeedbackController::class, 'get']);
        Route::get('/cadastrar', [FeedbackController::class, 'cadastrar']);
        Route::post('/editar', [FeedbackController::class, 'editar']);
        Route::post('/insert', [FeedbackController::class, 'insert']);
        Route::post('/update', [FeedbackController::class, 'update']);
        Route::post('/delete', [FeedbackController::class, 'delete']);
        Route::get('/excluir/{id}', [FeedbackController::class, 'excluir']);
        Route::get('/pesquisar', [FeedbackController::class, 'pesquisar']);
    });

    Route::prefix('consultores')->group(function () {
        Route::get('/', [ConsultorController::class, 'index']);
        Route::get('/cadastrar', [ConsultorController::class, 'cadastrar']);
        Route::post('/insert', [ConsultorController::class, 'insert']);
        Route::post('/update', [ConsultorController::class, 'update']);
        Route::post('/delete', [ConsultorController::class, 'delete']);
    });

    Route::prefix('advertencias')->group(function () {
        Route::get('/', [AdvertenciaController::class, 'index']);
        Route::get('/cadastrar', [AdvertenciaController::class, 'cadastrar']);
        Route::post('/insert', [AdvertenciaController::class, 'insert']);
        Route::post('/delete', [AdvertenciaController::class, 'delete']);
    });

    Route::get('/consultor/editar/{id}', [ConsultorController::class, 'editar']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
