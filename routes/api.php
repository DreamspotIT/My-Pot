<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoldItemController;
use App\Http\Controllers\Api\GoldOfferController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\GoldDiscountController;


// 🔓 Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login-password', [AuthController::class, 'loginWithPassword']);

// 🔒 Protected Routes (Authenticated)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/admin/users/{id}', [AdminController::class, 'viewUser']);
    Route::get('/admin/users', [AdminController::class, 'listUsers']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);

    // Authenticated User Actions
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/user/update', [AuthController::class, 'updateUser']);
    Route::delete('/user/delete', [AuthController::class, 'deleteUser']);

    // Gold Item Management
    Route::get('/gold-items', [GoldItemController::class, 'index']);
    Route::post('/gold-items', [GoldItemController::class, 'store']);
    Route::get('/gold-items/{id}', [GoldItemController::class, 'show']);
    Route::put('/gold-items/{id}', [GoldItemController::class, 'update']);
    Route::delete('/gold-items/{id}', [GoldItemController::class, 'destroy']);

    //Gold offers Management
    Route::get('/gold-offers', [GoldOfferController::class, 'index']);
    Route::post('/gold-offers', [GoldOfferController::class, 'store']);
    Route::get('/gold-offers/{id}', [GoldOfferController::class, 'show']);
    Route::put('/gold-offers/{id}', [GoldOfferController::class, 'update']);
    Route::delete('/gold-offers/{id}', [GoldOfferController::class, 'destroy']);

    //Gold discount Management
    Route::get('/gold-discounts', [GoldDiscountController::class, 'index']);
    Route::post('/gold-discounts', [GoldDiscountController::class, 'store']);
    Route::get('/gold-discounts/{id}', [GoldDiscountController::class, 'show']);
    Route::put('/gold-discounts/{id}', [GoldDiscountController::class, 'update']);
    Route::delete('/gold-discounts/{id}', [GoldDiscountController::class, 'destroy']);

});
