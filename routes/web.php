<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth','isAdmin']],function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

    Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    
    Route::get('add-category',[CategoryController::class,'add'])->name('add-category');

    Route::post('insert-category',[CategoryController::class,'insert'])->name('insert-category');

    
});
