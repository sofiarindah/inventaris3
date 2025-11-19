<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('users', UserController::class);

    // // ... route dashboard dan users
    // Route::resource('category', CategoryController::class);

    // // ... route dashboard, users, category
    // Route::resource('item', ItemController::class);

    // // ... route dashboard, users, category, item
    // Route::resource('loan', LoanController::class);

    // Route::resource('loan', LoanController::class);
    // Route::put('loan/{loan}/return', [LoanController::class, 'returnItem'])->name('loan.return');

    Route::get('/profil', [DashboardController::class, 'profile'])->name('profile');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);

        Route::resource('category', CategoryController::class);

        Route::resource('item', ItemController::class);

        Route::resource('loan', LoanController::class);

        Route::put('loan/{loan}/return', [LoanController::class, 'returnItem'])->name('loan.return');

    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';