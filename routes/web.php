<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $modules = json_decode(file_get_contents(app_path('modules.json')), true);
    
    return view('dashboard', compact('modules'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', function () {
    return view('products.list');
})->middleware(['auth', 'verified'])->name('product.list');

Route::get('/customers', function () {
    return view('customers.list');
})->middleware(['auth', 'verified'])->name('customer.list');

Route::get('/cms', function () {
    return view('cms.index');
})->middleware(['auth', 'verified'])->name('cms.index');

Route::get('/reports', function () {
    return view('reports.index');
})->middleware(['auth', 'verified'])->name('report.index');

Route::get('/system', function () {
    return view('system.index');
})->middleware(['auth', 'verified'])->name('system.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
