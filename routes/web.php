<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminBooksController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionBooksController;
use App\Http\Controllers\SessionCommentsController;
use App\Http\Controllers\TestController;

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

// PUBLIC routes
// books
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/book/{book:id}', [BookController::class, 'show']);
Route::get('/book/download/{book:id}', [BookController::class, 'download']);

// categories
Route::get('/categories/{category:id}', [CategoryController::class, 'show']);

// users
Route::get('/users/{user:id}', [UsersController::class, 'show']);
Route::get('/register', [UsersController::class, 'create']);
Route::post('/register', [UsersController::class, 'store']);

// sessions (log in and log out)
Route::get('/log-in', [SessionsController::class, 'create'])->name('login');
Route::post('/log-in', [SessionsController::class, 'store']);
Route::post('/log-out', [SessionsController::class, 'destroy']);


// PROTECTED routes
Route::middleware('auth')->group(function () {
    // books
    Route::get('/upload', [BookController::class, 'create']);
    Route::post('/upload', [BookController::class, 'store']);

    // comments
    Route::post('/add-comment', [CommentController::class, 'store']);

    // sessions - information on currently logged in user
    Route::get('/my-account', [SessionsController::class, 'edit']);
    Route::patch('/my-account', [SessionsController::class, 'update']);

    // sessions books - information on books of currently logged in user
    Route::resource('my-account/books', SessionBooksController::class)->only(['index', 'edit', 'update', 'destroy']);

    // sessions comments
    Route::resource('my-account/comments', SessionCommentsController::class)->only(['index', 'edit', 'update', 'destroy']);
});


// ADMIN routes
Route::middleware('admin')->group(function () {
    // books
    Route::resource('admin/books', AdminBooksController::class)->except('show');

    // users
    Route::resource('admin/users', AdminUsersController::class)->only(['index', 'edit', 'update', 'destroy']);

    // categories
    Route::resource('admin/categories', AdminCategoriesController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});

// test route
Route::get('test', [TestController::class, 'index']);
