<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\UnitsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
})->name('home.index');


// Auth
Route::get('register', [RegisterController::class,'show'])->name('register');
Route::post('register', [RegisterController::class,'register']);
Route::get('login', [LoginController::class,'show'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

// dashboard
Route::get('/dashboard', function(){
    return view('backend.dashboard');
})->middleware('auth')->name('dashboard');

// Admin user management (only admin|super-admin via controller constructor)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('users', UserController::class);
});


// Inventory Management Routes
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function() {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    // Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    // Categories routes
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categories}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categories}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categories}', [CategoriesController::class, 'destroy'])->name('categories.destroy');


    // Sub-categories routes
    Route::get('/subcategories', [SubCategoriesController::class, 'index'])->name('sub_categories.index');
    Route::get('/subcategories/create', [SubCategoriesController::class, 'create'])->name('sub_categories.create');
    Route::post('/subcategories', [SubCategoriesController::class, 'store'])->name('sub_categories.store');
    Route::get('/subcategories/{subCategories}', [SubCategoriesController::class, 'show'])->name('sub_categories.show');
    Route::get('/subcategories/{subCategories}/edit', [SubCategoriesController::class, 'edit'])->name('sub_categories.edit');
    Route::put('/subcategories/{subCategories}', [SubCategoriesController::class, 'update'])->name('sub_categories.update');
    Route::delete('/subcategories/{subCategories}', [SubCategoriesController::class, 'destroy'])->name('sub_categories.destroy');


    // Brands routes
    Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandsController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brands}', [BrandsController::class, 'show'])->name('brands.show');
    Route::get('/brands/{brands}/edit', [BrandsController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brands}', [BrandsController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brands}', [BrandsController::class, 'destroy'])->name('brands.destroy');


    // Units Routs
    Route::get('/units', [UnitsController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitsController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitsController::class, 'store'])->name('units.store');
    Route::get('/units/{units}', [UnitsController::class, 'show'])->name('units.show');
    Route::get('/units/{units}/edit', [UnitsController::class, 'edit'])->name('units.edit');
    Route::put('/units/{units}', [UnitsController::class, 'update'])->name('units.update');
    Route::delete('/units/{units}', [UnitsController::class, 'destroy'])->name('units.destroy');
});



