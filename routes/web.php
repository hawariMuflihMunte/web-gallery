<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LikeFotoController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::get('/register', [RegisterController::class, 'index']);
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
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
