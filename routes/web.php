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
// Permission for new files or folders chmod -R 777 ./

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
