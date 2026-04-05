<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

Route::get('/hash/{pass}', function ($pass) {
    return Hash::make($pass);
});

 
Route::get('/', function () {
    return view('welcome');
});
 
Route::middleware('auth')->group(function () {
    //Route::get('dashboard', function () {
    //    return view('dashboard');
    //})->name('dashboard');
 
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/products', 'index')->name('products.index');
        Route::get('/admin/products/create', 'create')->name('products.create');
        Route::post('/admin/products', 'store')->name('products.store');
        Route::get('/admin/products/show/{product}', 'show')->name('products.show');
        Route::get('/admin/products/{product}/edit', 'edit')->name('products.edit');
        Route::put('/admin/products/{product}', 'update')->name('products.update');
        Route::delete('/admin/products/{product}', 'destroy')->name('products.destroy');
 
        Route::get('/admin/deleted-products', 'trashedProducts')->name('products.trashed');
        Route::get('/admin/show-trashed-product/{id}', 'showTrashed')->name('trashed.show');
        Route::put('/admin/restore-product/{id}', 'restoreProduct')->name('trashed.restore');
        Route::delete('/admin/delete-product/{id}', 'destroyProduct')->name('trashed.delete');
    });
});
 
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    
    // Tambahan untuk Register
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerAction')->name('register.action');
    
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});