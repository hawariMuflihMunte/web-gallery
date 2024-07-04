<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Gallery\AlbumController;
use App\Http\Controllers\Gallery\FotoController;
use App\Http\Controllers\Gallery\LikeFotoController;
use App\Http\Controllers\Gallery\KomentarFotoController;
use App\Http\Controllers\Gallery\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/', function () {
        return redirect()->route('albums.index');
    });

    Route::resource('/albums', AlbumController::class);
    Route::resource('/photos', FotoController::class);
    Route::resource('/likes', LikeFotoController::class);
    Route::resource('/comments', KomentarFotoController::class);
    Route::resource('/user', UserController::class);

    Route::get('/logout', LogoutController::class)->name('logout');
});

Route::resource('/post', PostController::class);
