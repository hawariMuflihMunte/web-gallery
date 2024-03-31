<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Gallery\FotoController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Gallery\LikeFotoController;
use App\Http\Controllers\Gallery\KomentarFotoController;
use App\Http\Controllers\Profile\ProfileController;
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
        return redirect()->route('gallery.index');
    });
    Route::resource('/gallery', GalleryController::class);
    Route::resource('/foto', FotoController::class);
    Route::resource('/likefoto', LikeFotoController::class);
    Route::resource('/komentarfoto', KomentarFotoController::class);
    Route::resource('/profile', ProfileController::class);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
