<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthAccountController;
use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthBooksController;
use App\Http\Controllers\Auth\AuthCommentsController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\AdminCreate;
use App\Http\Livewire\Test3;

use function Termwind\render;

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
Route::get('/book/{book:id}', [BookController::class, 'show'])->middleware('auth');
Route::get('/book/download/{book:id}', [BookController::class, 'download']);

// categories
Route::get('/categories/{category:id}', [CategoryController::class, 'show']);

// users
Route::get('/users/{user:id}', [UsersController::class, 'show']);
Route::get('/register', [UsersController::class, 'create']);
Route::post('/register', [UsersController::class, 'store']);

// sessions (log in and log out)
Route::get('/log-in', [AuthAccountController::class, 'create'])->name('login')->middleware('guest');
Route::post('/log-in', [AuthAccountController::class, 'store'])->middleware('guest');
Route::post('/log-out', [AuthAccountController::class, 'destroy']);


// PROTECTED routes
Route::middleware('auth')->group(function () {
    // books
    Route::get('/upload', [BookController::class, 'create']);
    Route::post('/upload', [BookController::class, 'store']);

    // comments
    Route::post('/add-comment', [CommentController::class, 'store']);

    // sessions - information on currently logged in user
    Route::get('/my-account', [AuthAccountController::class, 'edit']);
    Route::patch('/my-account', [AuthAccountController::class, 'update']);

    // sessions books - information on books of currently logged in user
    Route::resource('my-account/books', AuthBooksController::class)->only(['index', 'edit', 'update', 'destroy']);

    // sessions comments
    Route::resource('my-account/comments', AuthCommentsController::class)->only(['index', 'edit', 'update', 'destroy']);
});


// ADMIN routes
Route::middleware('admin')->group(function () {
    // books
    Route::get('/admin/books', [AdminBooksController::class, 'index']);

    // users
    Route::resource('admin/users', AdminUsersController::class)->only(['index', 'edit', 'update', 'destroy']);

    // categories
    Route::resource('admin/categories', AdminCategoriesController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});

// test route
Route::get('test', AdminCreate::class);
