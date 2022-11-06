<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [AdminController::class, 'index']);

// ====================== Brand ====================== //
Route::group(['prefix' => 'dashboard/brands', 'as' => 'brand.'], function(){
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('create', [BrandController::class, 'create'])->name('create');
    Route::post('store', [BrandController::class, 'store'])->name('store');
    Route::get('{brand}/edit', [BrandController::class, 'edit'])->name('edit');
    Route::put('{brand}/update', [BrandController::class, 'update'])->name('update');
    Route::delete('{brand}/destroy', [BrandController::class, 'destroy'])->name('destroy');
});



// ====================== Categories ====================== //
Route::prefix('dashboard/categories')->name('category.')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('{category}/update', [CategoryController::class, 'update'])->name('update');
    Route::delete('{category}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});


// ====================== Products ====================== //
Route::prefix('dashboard/products')->name('product.')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
    Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
});