<?php

use App\Models\User;
use App\Mail\UserMail;
use App\Notifications\InvoicePad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AjaxCrudController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

// Route::get('/', function () {
//     // $data = [
//     //     'product'   => 'Laptop',
//     //     'invoice_no'    => 'INV-102',
//     //     'price'    => 1200,
//     // ];
//     // User::find(2)->notify(new InvoicePad($data));
//     return view('welcome');
// });

Route::get('mark-read',function(){
    Auth::user()->unreadNotifications->markAsRead();
    return back();
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
    // Queue
    Route::get('queue', [BrandController::class, 'queue'])->name('queue');
    Route::post('queue/store', [BrandController::class, 'queueStore'])->name('queue.store');
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
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('{product}/update', [ProductController::class, 'update'])->name('update');
    Route::delete('{product}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('{product}/show', [ProductController::class, 'show'])->name('show');
});
Auth::routes();


Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


// Route::group(['middleware'=> ['auth', 'email_verify']], function(){
//     Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
// });

Route::middleware(['auth', 'email_verify'])->group(function(){
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
    
});

Route::post('file/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('file.upload');

Route::get('ajax', [AjaxController::class, 'index'])->name('ajax.index');
Route::post('ajax/store', [AjaxController::class, 'store'])->name('ajax.store');
Route::post('ajax/show', [AjaxController::class, 'show'])->name('ajax.show');
Route::post('ajax/destroy', [AjaxController::class, 'destroy'])->name('ajax.destroy');
Route::post('ajax/edit', [AjaxController::class, 'edit'])->name('ajax.edit');
Route::post('ajax/update', [AjaxController::class, 'update'])->name('ajax.update');
Route::post('ajax/borad-select', [AjaxController::class, 'boardSelect'])->name('ajax.borad-select');

Route::get('/students', [AjaxCrudController::class, 'index'])->name('students.index');
Route::post('/store', [AjaxCrudController::class, 'store'])->name('students.store');
Route::post('/show', [AjaxCrudController::class, 'show'])->name('students.show');
Route::post('/edit', [AjaxCrudController::class, 'edit'])->name('students.edit');
Route::post('/update', [AjaxCrudController::class, 'update'])->name('students.update');
Route::post('/destroy', [AjaxCrudController::class, 'destroy'])->name('students.destroy');