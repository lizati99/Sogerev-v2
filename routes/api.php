<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Products API
Route::apiResource('products', ProductController::class);

// // Clients API
// Route::apiResource('clients', ClientController::class);

// // Suppliers API
// Route::apiResource('suppliers', SupplierController::class);

// // Categories API
// Route::apiResource('categories', CategoryController::class);
