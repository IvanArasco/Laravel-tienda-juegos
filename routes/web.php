<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GameController;

Route::redirect('/', '/games');

Route::get('/games', [GameController::class, 'index'])->name('games');

// Mostrar el formulario de login
Route::get('login', function () { 
    return view('login'); 
})->name('login');

// Procesar el login
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/logout', function () {
    Auth::logout();
   // return redirect('/');
})->name('logout');

// Mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
})->name('register');

// Procesar el registro
Route::post('register', [RegisterController::class, 'register'])->name('register.register');

// Mostrar el formulario de creación de un juego
Route::get('/createGame', function () {
    return view('creategame');
})->middleware('auth')->name('createGame');

// Procesar la creación de un juego
Route::post('createGame', [GameController::class, 'createGame'])->name('game.create')->middleware('auth');

Route::post('/cart/add/{id}', [OrderController::class, 'addToCart'])->name('cart.add');