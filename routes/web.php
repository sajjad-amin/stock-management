<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebsiteController::class, 'home'])->name('home');

Route::get('system/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('system')->middleware(['auth','verified', 'can:admin'])->group(function(){
    Route::prefix('products')->name('product.')->group(function(){
        Route::get('all', [ProductController::class, 'allProducts'])->name('all');
        Route::get('new', [ProductController::class, 'newProduct'])->name('new');
        Route::post('new', [ProductController::class, 'createProduct'])->name('new.create');
        Route::get('edit/{id?}', [ProductController::class, 'editProduct'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'updateProduct'])->name('update');
        Route::delete('delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete');
    });
    Route::prefix('sell')->name('sell.')->group(function(){
        Route::get('products', [SellController::class, 'getAll'])->name('products');
        Route::post('products', [SellController::class, 'sell'])->name('sell');
        Route::put('products', [SellController::class, 'returnProduct'])->name('return');
    });
});

require __DIR__.'/auth.php';
