<?php

use App\Http\Controllers\Admin\Post\IndexController;
use App\Http\Controllers\JwtAuth\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], static function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
Route::group(['middleware' => 'jwt.auth'], static function(){
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'admin'], static function () {
        Route::group(['namespace' => 'Post'], static function () {
            Route::get('index', [IndexController::class, '__invoke'])->name('admin.post.index');
        });
    });

    Route::get('postList',[PostController::class,'listPosts'])->name('post.list');
});


