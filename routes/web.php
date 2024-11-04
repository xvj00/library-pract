<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');

//Route::get('/books', [BookController::class, 'index']);
//Route::get('/books', [BookController::class, 'create']);

//Route::resource('book', \App\Http\Controllers\BookController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');


    Route::middleware('role:librarian')->group(function () {
        Route::resource('author', AuthorController::class);
        Route::resource('genre', GenresController::class);
        Route::resource('edition', EditionController::class);
        Route::resource('book', BookController::class);
//        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
//        Route::post('/book', [BookController::class, 'store'])->name('book.store');
//        Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
//        Route::patch('/book/{book}/update', [BookController::class, 'update'])->name('book.update');
//        Route::delete('/book/{book}/destroy', [BookController::class, 'destroy'])->name('book.destroy');


    });
    Route::resource('reservations', ReservationController::class);

    Route::middleware('role:admin')->group(function () {
        Route::resource('admin', AdminController::class);
        Route::post('admin/{id}/restore', [AdminController::class, 'restore'])->name('admin.restore');
        Route::delete('admin/{id}/forceDelete', [AdminController::class, 'forceDelete'])->name('admin.forceDelete');


    });

    Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';


