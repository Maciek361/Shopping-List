<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserShoppingsController;
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


//Public Routes
Route::post('/register/', [AuthController::class, 'register']);
Route::post('/login/', [AuthController::class, 'login']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('product', ProductController::class); //w tym dodawanie produktów do bazy
    Route::resource('shopping', ShoppingController::class); //dodawanie list i usuwanie - funkcja dla admina 
    Route::resource('user', UserController::class); // w tym wyświetlanie użytkowników
    Route::post('/shopping/{shopping}/products/{product}', [ShoppingController::class, 'attachProduct'])->name('shopping.attachProduct');
    Route::post('/shopping/{shopping}/products/{product}/update-quantity', [ShoppingController::class, 'updateQuantity']);
    Route::post('/shopping/{shopping}/products/{product}/update-checked', [ShoppingController::class, 'updatechecked']);
    Route::delete('shopping/{shopping}/products/{product}', [ShoppingController::class, 'detachProduct'])->name('shopping.detachProduct');
    Route::resource('user.shoppings', UserShoppingsController::class); // w tym wyświetlanie użytkowników - user/2/shoppings
    Route::post('/shopping/{shopping}/share', [ShoppingController::class, 'updateShared']);
    Route::post('/logout/', [AuthController::class, 'logout']);
});
