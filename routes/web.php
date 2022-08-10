<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ECashController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\TransactionController;
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

Route::prefix('system')->middleware(['auth','verified','can:admin'])->group(function(){
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('all', [CategoryController::class, 'allCategories'])->name('all');
        Route::get('find/{id}', [CategoryController::class, 'findCategory'])->name('find');
        Route::get('new', [CategoryController::class, 'newCategory'])->name('new');
        Route::post('new', [CategoryController::class, 'createCategory'])->name('new.create');
        Route::get('edit/{id?}', [CategoryController::class, 'editCategory'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'updateCategory'])->name('update');
        Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete');
    });
    Route::prefix('e-cash')->name('ecash.')->group(function(){
        Route::get('all', [ECashController::class, 'allECash'])->name('all');
        Route::post('new', [ECashController::class, 'createECash'])->name('new.create');
        Route::put('update/{id}', [ECashController::class, 'updateECash'])->name('update');
        Route::delete('delete/{id}', [ECashController::class, 'deleteECash'])->name('delete');
    });
    Route::prefix('transactions')->name('transactions.')->group(function(){
        Route::get('all', [TransactionController::class, 'allTransactions'])->name('all');
        Route::post('new', [TransactionController::class, 'makeTransaction'])->name('new.create');
        Route::delete('delete/{id}', [TransactionController::class, 'deleteTransaction'])->name('delete');
    });
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
    Route::prefix('invoice')->name('invoice.')->group(function(){
        Route::get('/{data}', [InvoiceController::class, 'showInvoice'])->name('show');
    });
});

Route::get('/install', [InstallController::class, 'install']);

require __DIR__.'/auth.php';
