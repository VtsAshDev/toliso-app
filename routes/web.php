<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
    Route::resource('profile.destroy', ProfileController::class)->except(['show',])->names('profile');
    Route::resource('categories', CategoryController::class)->except(['show'])->names('categories');
    Route::resource('transactions', TransactionController::class)->except(['show'])->names('transactions');
    Route::resource('savings', SavingController::class)->except(['show'])->names('savings');
});

require __DIR__.'/auth.php';
