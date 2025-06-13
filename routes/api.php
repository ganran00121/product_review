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

Route::post('register', [AuthController::class, 'register']); // register
Route::post('login', [AuthController::class, 'login']); // login

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('user', [AuthController::class,'me']); // Profile
    Route::post('logout', [AuthController::class,'logout']); // logout
    
    //Products 
    Route::middleware(['check.permission:product,create'])->post('/products', [ProductController::class, 'store']); // สร้างสินค้าใหม่ สร้างได้เฉพาะ  ADMIN หรือคนที่มีสิทธ์ Product create
    Route::middleware(['check.permission:product,update'])->put('/products/{id}', [ProductController::class, 'update']); //แก้ไขสินค้า ได้เฉพาะ  ADMIN หรือคนที่มีสิทธ์ Product update
    Route::middleware(['check.permission:product,delete'])->delete('/products/{id}', [ProductController::class, 'destroy']);// ลบสินค้า ได้เฉพาะ  ADMIN หรือคนที่มีสิทธ์ Product delete
    //Review Admin 
    Route::middleware(['check.permission:product,view'])->get('/all/reviews', [ReviewController::class, 'index']); //ดูreviewทั้งหมด ดูได้เฉพาะ  ADMIN หรือคนที่มีสิทธ์ Product View

    //Review
    Route::post('/reviews', [ReviewController::class, 'store']); //reviewสินค้า
    Route::get('/reviews', [ReviewController::class, 'ByOwner']);//ดูreviewสินค้าตัวเองทั้งหมด 
    Route::put('/reviews/{id}', [ReviewController::class, 'updateReview']); // แก้ไข Revirw สินค้า 
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroyReview']); // ลบ Review สินค้า

});

Route::get('/products',  [ProductController::class, 'index']); // ดูสินค้าทั้งหมด
Route::get('/products/{id}', [ProductController::class, 'show']); // ดูสินค้า เฉพาะเจาะจง
Route::get('/reviews/product/{id}', [ReviewController::class, 'byProduct']); // ดู Review สินค้า แบบเจาะจง
