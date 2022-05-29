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

Route::get('/users',[UserController::class,'index'])->name('user.index');
//Route::get('/post',"")->name('post.index');
//Route::get('/about',"")->name('about.index');
//Route::get('/contact',"")->name('contact.index');
