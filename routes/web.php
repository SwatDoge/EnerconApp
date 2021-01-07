<?php
use App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('pIndex');
Route::any('/profile/update', [ProfileController::class, 'update'])->name('pUpdate');
Route::post('/giverole', 'HomeController@insert');
Route::post('addrole', 'HomeController@create');
Route::any('/roles/{id}/edit', 'HomeController@edit');
Route::post('/roles/edit/{role}', 'HomeController@edit1');


Route::any('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('aIndex');
Route::any('/admin/{user}/edit', [App\Http\Controllers\Admincontroller::class, 'edit'])->name('aEdit');
Route::any('/admin/{user}/delete', [App\Http\Controllers\Admincontroller::class, 'destroy'])->name('aDelete');
Route::any('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('aUpdate');

