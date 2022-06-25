<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [CatalogController::class , 'index'])->name('products');
Route::get('/discount', [CatalogController::class , 'discount'])->name('products.discount');
Route::get('/category/{name}', [CatalogController::class , 'category'])->name('products.category');
Route::get('/products/{id}', [CatalogController::class , 'show'])->whereNumber('id')->name('products.show');


//ADMIN CRUD

// Route::put('/products/edit/{id}', [ProductController::class , 'update'])->middleware(['auth'])->name('products.update');

// Route::resource('/products',ProductController::class )->middleware('auth')->only([
//     'update',
//     'store',
// ]);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::get('/admin', [ProductController::class, 'index'])->middleware(['auth'])->name('admin');
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('products', ProductController::class )->except(['show']);
    Route::resource('category', CategoryController::class );
});

// Route::get('/dashboard',[ProductController::class, 'index'])->middleware(['auth'])->name('dashboard');
// Route::get('/dashboard/create',[ProductController::class, 'create'])->middleware(['auth'])->name('dashboard.create');
// Route::get('/dashboard/{id}/edit',[ProductController::class, 'edit'])->middleware(['auth'])->name('dashboard.edit');

require __DIR__.'/auth.php';
