<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SLController;
use App\Http\Controllers;

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
    return view('welcome', ['name' => 'Tycho']);
});

Auth::routes();
Route::post('/sl/update/{id}', [SLController::class, 'update']);
Route::resource('sl', App\Http\Controllers\SLController::class)->shallow();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
