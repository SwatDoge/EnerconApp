<?php
use App\Http\Controllers;
use App\Http\Controllers\ProfileController;
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

Route::any('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('pIndex');
Route::any('/profile/update', [ProfileController::class, 'update'])->name('pUpdate');

Route::any('/admin/roles', 'AdminController@roles');
Route::get('/admin/roles/{id}/edit', 'AdminController@editrole');
Route::post('/admin/roles/wijzigen/{id}', 'AdminController@changerole');
Route::post('/admin/roles/delete/{id}', 'AdminController@deleterole');
Route::any('/admin/roles/addrole', 'AdminController@createrole');
Route::post('/admin/roles/add', 'AdminController@insertrole');


Route::any('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('aIndex');
Route::any('/admin/{user}/edit', [App\Http\Controllers\Admincontroller::class, 'edit'])->name('aEdit');
Route::any('/admin/{user}/delete', [App\Http\Controllers\Admincontroller::class, 'destroy'])->name('aDelete');
Route::any('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('aUpdate');

