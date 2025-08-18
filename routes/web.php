<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'))->middleware('auth')->name('welcome');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes protected with login (categories, products, reminders...)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // User profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Products
    Route::resource('products', ProductController::class);
    Route::delete('/products/{product}/photo', [ProductController::class, 'removePhoto'])->name('products.removePhoto');

    // Products rates
    Route::post('/products/{product}/rates', [RateController::class, 'store'])->name('rates.store');
    Route::put('/rates/{rate}', [RateController::class, 'update'])->name('rates.update');
    Route::delete('/rates/{rate}', [RateController::class, 'destroy'])->name('rates.destroy');

    // Calendar
    Route::get('/calendar', [ReminderController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [ReminderController::class, 'events'])->name('calendar.events');

    // Reminders
    Route::resource('reminders', ReminderController::class)->only(['create', 'store', 'destroy']);

    // Exports
    Route::get('/categories/export/pdf', [ExportController::class, 'exportCategoriesPDF'])->name('categories.export.pdf');
    Route::get('/products/export/pdf', [ExportController::class, 'exportProductsPDF'])->name('products.export.pdf');
});

/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
