<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin views:
Route::get('/home', [AdminController::class, 'index']);
Route::get('/category_page', [AdminController::class, 'categoryPage']);
Route::get('/add_book_page', [AdminController::class, 'addBookPage']);
Route::get('/show_books', [AdminController::class, 'showBooks']);
Route::get('/edit_book/{id}', [AdminController::class, 'editBook']);

// Admin APIs:
Route::post('/add_category', [AdminController::class, 'addCategory']);
Route::get('/delete_cat/{id}', [AdminController::class, 'deleteCategory']);
Route::get('status_approved/{id}', [AdminController::class, 'approveBook']);
Route::get('status_returned/{id}', [AdminController::class, 'returnBook']);
Route::get('status_not_approved/{id}', [AdminController::class, 'notApproveBook']);

Route::post('/add_book', [AdminController::class, 'addBooks']);
Route::get('/delete_book/{id}', [AdminController::class, 'deleteBook']);
Route::post('/update_book', [AdminController::class, 'updateBook']);


// User Views:
Route::get('/explore', [HomeController::class, 'explorePage']);
Route::get('/book_details/{id}', [HomeController::class, 'bookDetails']);


// User APIs:
Route::get('/borrow_book/{id}', [HomeController::class, 'borrowBook']);
Route::get('/show_user_history', [HomeController::class, 'history']);
Route::get('/cancel_request/{id}', [HomeController::class, 'cancelRequest']);
Route::post('/search', [HomeController::class, 'search']);


