<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PromoController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home'); // Esta vista dependerá de los permisos, de momento la sustituye la siguiente

Route::get('/escuelas', [SchoolController::class, 'index'])->name('escuelas');

Route::get('/promos', [PromoController::class, 'index'])->name('promos');
// Route::get('/candidaturas/{id}', [PromoController::class, 'show'])->name('candidaturas');

//Route Hooks - Do not delete//
	Route::view('tokens', 'livewire.tokens.index')->middleware('auth');
	Route::view('escuelas-admin', 'livewire.schools.index')->middleware('auth');
	Route::view('roles', 'livewire.roles.index')->middleware('auth');
	Route::view('promos-admin', 'livewire.promos.index')->middleware('auth');
	Route::view('perfiles', 'livewire.profiles.index')->middleware('auth');
	Route::view('candidaturas', 'livewire.candidates.index')->middleware('auth');