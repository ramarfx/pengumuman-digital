<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

//auth
Route::get('/register', [RegisterController::class, 'create'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', LogoutController::class)->name('logout');

//post
Route::resource('/post', PostController::class);

//user
Route::get('/posts/user', function () {
    return view('user.show-post');
});


//list user
Route::get('/users', function () {
    return view('dashboard.partials.show-user');
});
