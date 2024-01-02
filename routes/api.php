<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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
// Route::resource('products', ProductController::class); //dodaj except lub only jak chcesz wyeliminować któreś routery
// Route::get('/products/', function () {
//     return ProductResource::collection(Products::all());
// });



Route::resource('product', ProductController::class);
Route::resource('shopping', ShoppingController::class);
Route::resource('user', UserController::class);

Route::delete('shopping/{shopping}/products/{product}', [ShoppingController::class, 'detachProduct'])->name('shopping.detachProduct');
Route::post('/shopping/{shopping}/products/{product}', [ShoppingController::class, 'attachProduct'])->name('shopping.attachProduct');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


    // Route::resource('shopping-lists', ShoppingListController::class);

});
