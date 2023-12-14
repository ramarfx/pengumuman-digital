<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\post\PostController;
use App\Http\Controllers\admin\post\AcceptPostController;
use App\Http\Controllers\user\BookmarkController;
use App\Models\User;

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

// HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/logout', LogoutController::class)->name('logout');
});


Route::middleware(['auth', 'post.crud'])->group(function () {
    // DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'update'])->name('users.update');
    // Post routes
    Route::resource('/post', PostController::class);
    Route::patch('/post/{post}/accept', [AcceptPostController::class, '__invoke'])->name('post.accept');

    //route bookmarks
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/{post}', [BookmarkController::class, 'store'])->name('bookmark.store');
});



// User routes
// Route::get('/posts/user', [UserController::class, 'showPost']);

// User list
