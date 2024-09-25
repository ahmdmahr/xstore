<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
//     return view('welcome');
// });

Route::get('/',[FrontendController::class,'index']);
Route::get('/f-categories',[FrontendController::class,'categories'])->name('f-categories');
Route::get('/view-category/{category}',[FrontendController::class,'viewcategory'])->name('view-category');
Route::get('/view-product/{product}',[FrontendController::class,'viewproduct'])->name('view-product');




Auth::routes();

Route::get('/load-cart-data',[CartController::class,'cartcount'])->name('load-cart-data');
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistcount'])->name('load-wishlist-data');


Route::post('/add-to-cart',[CartController::class,'addproduct'])->name('add-to-cart');
Route::post('/delete-cart-item',[CartController::class,'deleteproduct'])->name('delete-cart-item');
Route::post('/update-cart-item-qty',[CartController::class,'updatecart'])->name('updatecart');

Route::post('/add-to-wishlist',[WishlistController::class,'add'])->name('add-to-wishlist');
Route::post('/delete-wishlist-item',[WishlistController::class,'deleteitem'])->name('delete-wishlist-item');



Route::group(['middleware'=>'auth'],function(){
    Route::get('cart',[CartController::class,'viewcart'])->name('cart');
    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout.index');
    Route::post('place-order',[CheckoutController::class,'placeorder'])->name('place-order');
    
    Route::get('my-orders',[UserController::class,'index'])->name('my-orders');
    Route::get('view-oder/{order}',[UserController::class,'vieworder'])->name('view-order');

    Route::get('wishlist',[WishlistController::class,'index'])->name('wishlist');

});


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth','isAdmin']],function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

    Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    Route::get('add-category',[CategoryController::class,'add'])->name('add-category');
    Route::post('insert-category',[CategoryController::class,'insert'])->name('insert-category');
    Route::get('edit-category/{category}',[CategoryController::class,'edit'])->name('edit-category');
    Route::put('update-category/{category}',[CategoryController::class,'update'])->name('update-category');
    Route::get('delete-category/{category}',[CategoryController::class,'destroy'])->name('delete-category');

    Route::get('products',[ProductController::class,'index'])->name('products.index');
    Route::get('add-product',[ProductController::class,'add'])->name('add-product');
    Route::post('insert-product',[ProductController::class,'insert'])->name('insert-product');
    Route::get('edit-product/{product}',[ProductController::class,'edit'])->name('edit-product');
    Route::put('update-product/{product}',[ProductController::class,'update'])->name('update-product');
    Route::get('delete-product/{product}',[ProductController::class,'destroy'])->name('delete-product');


    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('admin/view-order/{order}',[OrderController::class,'vieworder'])->name('orders.view');
    Route::put('update-order/{order}',[OrderController::class,'updateorder'])->name('orders.update');
    Route::get('order-history',[OrderController::class,'orderhistory'])->name('orders.history');

    Route::get('users',[AdminUserController::class,'users'])->name('users.index');
    Route::get('view-user/{user}',[AdminUserController::class,'viewuser'])->name('users.view');
    

});

