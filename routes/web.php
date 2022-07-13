<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

Route::prefix('system')->middleware(['auth','verified'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('products')->name('product.')->group(function(){
        Route::get('all', [ProductController::class, 'allProducts'])->name('all');
        Route::get('new', [ProductController::class, 'newProduct'])->name('new');
        Route::post('new', [ProductController::class, 'createProduct'])->name('new.create');
        Route::get('edit/{id?}', [ProductController::class, 'editProduct'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'updateProduct'])->name('update');
    });
});

require __DIR__.'/auth.php';
