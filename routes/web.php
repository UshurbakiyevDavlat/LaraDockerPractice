<?php

use App\Http\Controllers\UserController;
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
// Permission for new files or folders chmod -R 777 ./ && chmod -R 777 /folder path

Route::controller(UserController::class)->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/user/getAll', [UserController::class, 'getUsers'])->name('user.show');
    Route::get('/user/withTrash', [UserController::class, 'getUsersWithTrashed'])->name('user.withTrash');
    Route::get('/user/get_by_id', [UserController::class, 'getUser'])->name('user.show_by_id');

    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/fake_create', [UserController::class, 'factory_create'])->name('user.fake_create');

    Route::put('/user/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::delete('/user/delete', [UserController::class, 'delete'])->name('user.delete');

});
