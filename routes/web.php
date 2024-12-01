<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\Librarian\BookingManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::get('/catalog', [BookController::class, 'showCatalog'])->name('book.catalog');

Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('profile/reservations', [ReservationController::class, 'userReservations'])->name('reservation.user.index');
    Route::post('profile/reservations/{book}/cancel', [ReservationController::class, 'cancel'])->name('reservation.user.cancel');
    Route::middleware('role:librarian')->group(function () {

        Route::get('reservations', [BookingManagementController::class, 'index'])->name('reservations.index');
        Route::post('reservations/{book}/cancel', [BookingManagementController::class, 'cancel'])->name('reservations.cancel');
        Route::post('reservations/{book}/confirm', [BookingManagementController::class, 'confirm'])->name('reservations.confirm');
        Route::post('reservations/{book}/given', [BookingManagementController::class, 'given'])->name('reservations.given');

        Route::resource('author', AuthorController::class);
        Route::resource('genre', GenresController::class);
        Route::resource('edition', EditionController::class);
//        Route::resource('book', BookController::class);
        Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::patch('/book/{book}/update', [BookController::class, 'update'])->name('book.update');
        Route::delete('/book/{book}/destroy', [BookController::class, 'destroy'])->name('book.destroy');

    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('admin', UserController::class);

        Route::post('admin/{id}/restore', [UserController::class, 'restore'])->name('admin.restore');
        Route::delete('admin/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('admin.forceDelete');
    });

    Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/passwordUpdate', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ProfileController::class, 'imageUpdate'])->name('profile.imageUpdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



