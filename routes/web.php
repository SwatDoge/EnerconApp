<?php
use App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SLController;

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

Route::get('/', function() {
    return view('index');
})->middleware('auth');

Auth::routes();
Route::post('/sl/update/{id}', [SLController::class, 'update']);
Route::get('/sl/create', 'SLController@create')->name('slCreate');
Route::post('/sl', 'SLController@store')->name('slStore');
Route::get('/sl/index', 'SLController@index')->name('slIndex');
Route::get('/sl/{id}', 'SLController@show')->name('slShow');
Route::get('/sl/{id}/edit', 'SLController@edit')->name('slEdit');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-pdf-file-{id}', 'SLController@PDF')->name('slPDF');
Route::get('/create-word-file-{id}', 'SLController@Word')->name('slWord');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/sl/update/{id}', [SLController::class, 'update']);
    Route::get('/sl/create', 'SLController@create')->name('slCreate');
    Route::post('/sl', 'SLController@store')->name('slStore');
    Route::get('/sl/index', 'SLController@index')->name('slIndex');
    Route::get('/sl/{id}/edit', 'SLController@edit')->name('slEdit');
    Route::any('/sl/{id}/delete', [App\Http\Controllers\SLController::class, 'destroy'])->name('slDelete');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::any('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('pIndex');
    Route::any('/profile/update', [ProfileController::class, 'update'])->name('pUpdate');
});

//Roles LOL
Route::group(['middleware' => ['admin']], function () {
    Route::any('/admin/roles', 'AdminController@roles')->name('rIndex');
    Route::get('/admin/roles/{id}/edit', 'AdminController@editrole');
    Route::post('/admin/roles/wijzigen/{id}', 'AdminController@changerole');
    Route::post('/admin/roles/delete/{id}', 'AdminController@deleterole');
    Route::any('/admin/roles/addrole', 'AdminController@createrole');
    Route::post('/admin/roles/add', 'AdminController@insertrole');
});

//Admin
Route::group(['middleware' => 'admin'], function () {
    Route::any('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('aIndex');
    Route::any('/admin/{user}/edit', [App\Http\Controllers\Admincontroller::class, 'edit'])->name('aEdit');
    Route::any('admin/createuser', 'AdminController@create')->name('aCreate');
    Route::any('/admin/{user}/delete', [App\Http\Controllers\Admincontroller::class, 'destroy'])->name('aDelete');
    Route::any('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('aUpdate');
    Route::get('/admin/users/create', 'AdminController@store')->name('aStore');
});

//unAuthorized
Route::any('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorized'])->name('unauthorized');
