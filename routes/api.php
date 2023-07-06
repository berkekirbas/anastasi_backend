<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Util\UtilController;
use App\Http\Controllers\Util\PublicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('editUserInfo','editUserInfo');
    Route::get('me', 'me');
});

Route::controller(BrandsController::class)->group(function(){
    Route::get('brands', 'index');
    Route::post('brand', 'store');
    Route::get('brand/{id}', 'show');
    Route::put('brand/{id}', 'update');
    Route::delete('brand/{id}', 'destroy');
});

Route::controller(CategoriesController::class)->group(function(){
    Route::get('categories', 'index');
    Route::post('category', 'store');
    Route::get('category/{id}', 'show');
    Route::put('category/{id}', 'update');
    Route::delete('category/{id}', 'destroy');
});

Route::controller(ProductsController::class)->group(function(){
    Route::get('products', 'index');
    Route::post('product', 'store');
    Route::get('product/{id}', 'show');
    Route::put('product/{id}', 'update');
    Route::delete('product/{id}', 'destroy');
});

Route::controller(UtilController::class)->group(function(){
    Route::get('getBrandWithCategory/{id}','getBrandWithCategory'); // marka ile kategorileri çekme (+)
    Route::get('getBrandWithProduct/{id}','getBrandWithProduct'); // marka ile ürün çekme (+)

    Route::get('getCategoriesWithBrand', 'getCategoriesWithBrand'); // kategorileri marka ile çkeme
    Route::get('getProductsWithCategoryAndBrand', 'getProductsWithCategoryAndBrand'); // ürünü kategori ve markayla çekme

    Route::get('getCategoryWithBrand/{id}','getCategoryWithBrand'); // kategori ile markayı çekme (+)
    Route::get('getCategoryWithProduct/{id}','getCategoryWithProduct'); // kategori ile ürün çekme (+)

    Route::get('getProductWithCategory/{id}','getProductWithCategory'); // ürünü kategori ile çekme (+)
    Route::get('getProductWithBrand/{id}','getProductWithBrand'); // ürünü marka ile çekme (+)
    Route::get('getProductWithCategoryAndBrand/{id}','getProductWithCategoryAndBrand'); // ürünü kategori ve marka ile çekme (+)

    Route::get('getBrandsWithAllProductsAndAllCategories/{id}','getBrandsWithAllProductsAndAllCategories'); // Markanın tüm ürünlerini ve kategorilerini çekme (+)
});

Route::controller(PublicController::class)->group(function (){
   Route::get('getBrands', 'getBrands');
   Route::get('_public_getBrandsWithAllProductsAndAllCategories/{id}','_public_getBrandsWithAllProductsAndAllCategories');
   Route::get('getPhoneNumberForOrder','getPhoneNumberForOrder');
});



