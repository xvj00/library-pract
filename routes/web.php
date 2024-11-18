<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LibrarianController;

Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::get('/catalog', [BookController::class, 'showCatalog'])->name('book.catalog');

//Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');

//Route::get('/books', [BookController::class, 'index']);
//Route::get('/books', [BookController::class, 'create']);

//Route::resource('book', \App\Http\Controllers\BookController::class);

Route::get('/profile', function () {
    return view('pages.user.user_dashboard');
})->middleware(['auth', 'verified'])->name('profile.edit');

Route::middleware('auth')->group(function () {

//    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('profile/reservations', [ReservationController::class, 'userReservations'])->name('reservation.user.index');
    Route::post('profile/reservations/{book}/cancel', [ReservationController::class, 'cancel'])->name('reservation.user.cancel');
    Route::middleware('role:librarian')->group(function () {

        Route::get('reservations', [LibrarianController::class, 'index'])->name('reservations.index');
        Route::post('reservations/{book}/cancel', [LibrarianController::class, 'cancel'])->name('reservations.cancel');
        Route::post('reservations/{book}/confirm', [LibrarianController::class, 'confirm'])->name('reservations.confirm');
        Route::post('reservations/{book}/given', [LibrarianController::class, 'given'])->name('reservations.given');

        Route::resource('author', AuthorController::class);
        Route::resource('genre', GenresController::class);
        Route::resource('edition', EditionController::class);
        Route::resource('book', BookController::class);
        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/book', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::patch('/book/{book}/update', [BookController::class, 'update'])->name('book.update');
        Route::delete('/book/{book}/destroy', [BookController::class, 'destroy'])->name('book.destroy');


    });


    Route::middleware('role:admin')->group(function () {
        Route::resource('admin', AdminController::class);

        Route::post('admin/{id}/restore', [AdminController::class, 'restore'])->name('admin.restore');
        Route::delete('admin/{id}/forceDelete', [AdminController::class, 'forceDelete'])->name('admin.forceDelete');


    });

    Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ProfileController::class, 'imageUpdate'])->name('profile.imageUpdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';


