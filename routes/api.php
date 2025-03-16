<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\PurchaseApiController;
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

// Route::middleware('auth:sanctum')->get('/userss', function () {
//     return "tested";
// });
Route::POST('/register',[UserController::class,'register'])->name('register-api');
Route::POST('/create-token',[UserController::class,'createToken'])->name('create-token');
Route::get('/not/auth', [UserController::class,'notAuthorize'])->name('auth.fail.token');

Route::middleware('auth:sanctum')->group(function () {
    // Product API Resource Route
    Route::resource('products', ProductApiController::class);

    // Purchase-related routes
    Route::post('/purchase', [PurchaseApiController::class, 'purchase'])->name('purchase');
    Route::get('/purchase/all', [PurchaseApiController::class, 'index'])->name('purchase.display');
    Route::put('/purchase/status/{uuid}', [PurchaseApiController::class, 'updateStatus'])->name('purchase.status');
    Route::get('/purchase/{uuid}', [PurchaseApiController::class, 'singlePurchase'])->name('purchase.single');
});