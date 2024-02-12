<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UploadManager;
use App\Http\Controllers\ImageUploadController;
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
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('auth');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/', function () {
        return view('home');
    });
});

// Exercise
Route::get('/upload', [UploadManager::class, 'upload'])->name('upload');
Route::post('/upload', [UploadManager::class, 'uploadPost'])->name('upload.post');

// Exercise #2
Route::get('/upload-image', [ImageUploadController::class, 'index']);
Route::post('/upload-image', [ImageUploadController::class, 'store'])->name('upload.image.post');
