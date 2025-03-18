<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GameController;

Route::redirect('/', '/games');

Route::resource('games', GameController::class);

// Ruta para mostrar el formulario de login
Route::get('login', function () {
    return view('login');
})->name('login');

// Ruta para procesar el login
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');


// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
})->name('register');

// Ruta para procesar el registro
Route::post('register', [RegisterController::class, 'register'])->name('register.register');


