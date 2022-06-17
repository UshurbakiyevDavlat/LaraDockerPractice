<?php

use App\Http\Controllers\Admin\Post\IndexController as AdminIndex;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Tag\CreateController;
use App\Http\Controllers\Tag\DestroyController;
use App\Http\Controllers\Tag\EditController;
use App\Http\Controllers\Tag\IndexController;
use App\Http\Controllers\Tag\ListController;
use App\Http\Controllers\Tag\StoreController;
use App\Http\Controllers\Tag\UpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', static function () {
    return view('welcome');
});
// Permission for new files or folders sudo chmod -R 777 ./

Route::controller(UserController::class)->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

        Route::get('/list/all', [UserController::class, 'list'])->name('user.list');
        Route::get('/list/withTrash', [UserController::class, 'all_and_trashed'])->name('user.list.trash');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');

        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/fake_store', [UserController::class, 'factory_store'])->name('user.fake_store');

        Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');

        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.delete');

    });
});

Route::resources([
    'claim' => ClaimController::class,
    'info' => InfoController::class,
    'post' => PostController::class,
]);

Route::group(['namespace' => 'Tag'], static function () {
    Route::prefix('tags')->group(function () {
        Route::get('/', [IndexController::class, '__invoke'])->name('tag.index');
        Route::get('/create', [CreateController::class, '__invoke'])->name('tag.create');
        Route::get('{tag}/edit', [EditController::class, '__invoke'])->name('tag.edit');
        Route::get('/list', [ListController::class, '__invoke'])->name('tag.list');

        Route::post('/store', [StoreController::class, '__invoke'])->name('tag.store');
        Route::patch('/update/{tag}', [UpdateController::class, '__invoke'])->name('tag.update');
        Route::delete('/destroy/{tag}', [DestroyController::class, '__invoke'])->name('tag.destroy');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], static function () {
    Route::group(['namespace' => 'Post'], static function () {
        Route::get('index', [AdminIndex::class, '__invoke'])->name('admin.post.index');
    });
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
