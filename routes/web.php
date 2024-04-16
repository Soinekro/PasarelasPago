<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IziPay\PayController as IziPayPayController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[IziPayPayController::class, 'index']);
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('izi-pay/success', [IziPayPayController::class, 'success'])->name('success');

