<?php

use App\Http\Controllers\DamageEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
}) -> name('/');

Route::resource('/vehicles', VehicleController::class) -> except(['destroy']) -> middleware('auth');

Route::resource('/damage-events', DamageEventController::class) -> middleware('auth');

Route::resource('/search-histories', SearchHistoryController::class) -> except(['create', 'edit', 'show']) -> middleware('auth');

Route::resource('/users', UserController::class) -> only(['index', 'update']) -> middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
