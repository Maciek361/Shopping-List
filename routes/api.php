<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
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


//Public Routes
// Route::resource('product', ProductController::class); //w tym dodawanie produktów
// Route::resource('shopping', ShoppingController::class); //dodawanie list 
// Route::resource('user', UserController::class); // w tym wyświetlanie użytkowników
Route::post('/register/', [AuthController::class, 'register']);
Route::post('/login/', [AuthController::class, 'login']);

// Route::delete('shopping/{shopping}/products/{product}', [ShoppingController::class, 'detachProduct'])->name('shopping.detachProduct');
// Route::post('/shopping/{shopping}/products/{product}', [ShoppingController::class, 'attachProduct'])->name('shopping.attachProduct');
// Route::post('/shopping/{shopping}/products/{product}/update-quantity', [ShoppingController::class, 'updateQuantity']);
// Route::post('/shopping/{shopping}/products/{product}/update-checked', [ShoppingController::class, 'updatechecked']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('product', ProductController::class); //w tym dodawanie produktów
    Route::resource('shopping', ShoppingController::class); //dodawanie list i usuwanie
    Route::post('/shopping/{shopping}/products/{product}', [ShoppingController::class, 'attachProduct'])->name('shopping.attachProduct');
    Route::post('/shopping/{shopping}/products/{product}/update-quantity', [ShoppingController::class, 'updateQuantity']);
    Route::post('/shopping/{shopping}/products/{product}/update-checked', [ShoppingController::class, 'updatechecked']);
    Route::post('/logout/', [AuthController::class, 'logout']);
    Route::delete('shopping/{shopping}/products/{product}', [ShoppingController::class, 'detachProduct'])->name('shopping.detachProduct');


});

// Route::middleware('auth:sanctum')->get('/user', function () {


//     Route::get('/products/search/{name}', [ProductController::class, 'search']);

// });