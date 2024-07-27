<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MoreInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::delete('/products/{product}', 'destroy')->name('products.destroy');
    });

    // More Info routes
    Route::controller(MoreInfoController::class)->group(function () {
        Route::get('/products/{product}/more-info/create', 'create')->name('more_infos.create');
        Route::post('/more_infos', 'store')->name('more_infos.store');
        Route::get('/more_infos/{more_info}/edit', 'edit')->name('more_infos.edit');
        Route::put('/more_infos/{more_info}', 'update')->name('more_infos.update');
        Route::delete('/more_infos/{more_info}', 'destroy')->name('more_infos.destroy');
    });
});

require __DIR__ . '/auth.php';
