<?php

use Illuminate\Support\Facades\Route;
use Modules\Commerce\Http\Controllers\CategoryController;
use Modules\Commerce\Http\Controllers\ProductController;

Route::prefix('commerce')->name('commerce.')->middleware(['auth', 'verified'])->group(function () {
  Route::prefix('/categories')->name('category.')->controller(CategoryController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{slug?}', 'edit')->name('edit');
    Route::post('/store/{id?}', 'store')->name('store');
    Route::delete('/delete/{id?}', 'destroy')->name('destroy');
  });

  Route::prefix('/products')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{slug?}', 'edit')->name('edit');
    Route::post('/store/{id?}', 'store')->name('store');
    Route::delete('/delete/{id?}', 'destroy')->name('destroy');
  });
});
