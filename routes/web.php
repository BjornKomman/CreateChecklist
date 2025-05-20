<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDependencyController;
use App\Http\Controllers\InactiveRelationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::resource('products', ProductController::class);
Route::resource('dependencies', ProductDependencyController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
Route::resource('inactive-relations', InactiveRelationController::class)->only(['index']);
Route::resource('products', ProductController::class)->middleware('auth');

Route::prefix('inactive-relations')->name('inactive-relations.')->group(function () {
    Route::get('/', [InactiveRelationController::class, 'index'])->name('index');
    Route::post('{inactiveRelation}/reactivate', [InactiveRelationController::class, 'reactivate'])->name('reactivate');
    Route::delete('{inactiveRelation}/force-delete', [InactiveRelationController::class, 'forceDelete'])->name('force-delete');
    Route::post('{inactiveRelation}/set-inactive', [InactiveRelationController::class, 'setInactive'])->name('set-inactive');
});


Route::get('products/inactive', [ProductController::class, 'inactive'])->name('products.inactive')->middleware('auth');

require __DIR__.'/auth.php';
