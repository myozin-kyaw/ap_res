<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registeration Routes...
    'reset' => false,  // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]); 

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// change to
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('home');
Route::resource('/dish', App\Http\Controllers\DishesController::class);