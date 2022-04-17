<?php

use App\Http\Controllers\DiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dice', [DiceController::class, 'index'])->name('dice.index');
Route::get('/dice/play', [DiceController::class, 'play'])->name('dice.play');
Route::post('/dice', [DiceController::class, 'store'])->name('dice.store');
Route::post('/dice/reset', [DiceController::class, 'reset'])->name('dice.reset');
Route::post('/dice/roll', [DiceController::class, 'roll'])->name('dice.roll');
Route::post('/dice/count/{id}', [DiceController::class, 'count'])->name('dice.count');
