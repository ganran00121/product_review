<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('user', [AuthController::class,'me']);
    Route::post('logout', [AuthController::class,'logout']);
    
    //Products 
    Route::middleware(['check.permission:product,create'])->post('/products', [ProductController::class, 'store']);


    //Review
    Route::post('/reviews', [ReviewController::class, 'store']);
});

Route::get('/products',  [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/reviews/product/{id}', [ReviewController::class, 'byProduct']);
