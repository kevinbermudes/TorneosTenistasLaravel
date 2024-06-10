<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenistaController;
use App\Http\Controllers\TorneoController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas públicas


// Ruta principal para la página de inicio
Route::get('/', [TenistaController::class, 'index'])->name('tenistas.index');

// Rutas públicas para tenistas
Route::get('/tenistas', [TenistaController::class, 'index'])->name('tenistas.index');
Route::get('/tenistas/{id}', [TenistaController::class, 'show'])->name('tenistas.show')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
Route::get('/tenista/pdf/{id}', [PDFController::class, 'generatePDF'])->name('tenista.pdf')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico

// Rutas protegidas para tenistas
Route::group(['prefix' => 'tenistas', 'middleware' => 'auth'], function () {
    Route::get('/create', [TenistaController::class, 'create'])->name('tenistas.create');
    Route::post('/', [TenistaController::class, 'store'])->name('tenistas.store');
    Route::get('/{id}/edit', [TenistaController::class, 'edit'])->name('tenistas.edit')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
    Route::put('/{id}', [TenistaController::class, 'update'])->name('tenistas.update')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
    Route::delete('/{id}', [TenistaController::class, 'destroy'])->name('tenistas.destroy')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
    Route::get('/{id}/editImage', [TenistaController::class, 'editImage'])->name('tenistas.editImage')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
    Route::patch('/{id}/updateImage', [TenistaController::class, 'updateImage'])->name('tenistas.updateImage')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
    Route::get('/deleted', [TenistaController::class, 'deleted'])->name('tenistas.deleted');
    Route::put('/restore/{id}', [TenistaController::class, 'restore'])->name('tenistas.restore')->where('id', '[0-9]+'); // Asegurarse que el id sea numérico
});
Route::group(['prefix' => 'torneos', 'middleware' => 'auth'], function () {
    Route::get('/', [TorneoController::class, 'index'])->name('torneos.index');
    Route::get('/create', [TorneoController::class, 'create'])->name('torneos.create');
    Route::post('/', [TorneoController::class, 'store'])->name('torneos.store');
    Route::get('/deleted', [TorneoController::class, 'deleted'])->name('torneos.deleted');
    Route::get('/{id}', [TorneoController::class, 'show'])->name('torneos.show');
    Route::get('/{id}/edit', [TorneoController::class, 'edit'])->name('torneos.edit');
    Route::put('/{id}', [TorneoController::class, 'update'])->name('torneos.update');
    Route::delete('/{id}', [TorneoController::class, 'destroy'])->name('torneos.destroy');
    Route::get('/{id}/editImage', [TorneoController::class, 'editImage'])->name('torneos.editImage');
    Route::put('/{id}/updateImage', [TorneoController::class, 'updateImage'])->name('torneos.updateImage');
    Route::put('/restore/{id}', [TorneoController::class, 'restore'])->name('torneos.restore');
    Route::get('/{id}/inscribir', [TorneoController::class, 'inscribir'])->name('torneos.inscribir');
    Route::post('/{id}/inscribirTenista', [TorneoController::class, 'inscribirTenista'])->name('torneos.inscribirTenista');
    Route::post('/{id}/finalizar', [TorneoController::class, 'finalizar'])->name('torneos.finalizar');
});


require __DIR__ . '/auth.php';
