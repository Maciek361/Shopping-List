<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Controllers\ShoppingListController;
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
Route::resource('shopping-lists', ShoppingListController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

  
// Route::resource('shopping-lists', ShoppingListController::class);
    
});
