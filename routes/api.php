<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//roles
Route::apiResource('roles', RoleController::class);

// users
Route::apiResource('users', UserController::class);

// permissions
Route::apiResource('permissions', PermissionController::class);

// entreprise
Route::apiResource('enterprises', EntrepriseController::class);

// stock
Route::apiResource('stocks', StockController::class);
//payment type
Route::apiResource('payment-types', PaymentTypeController::class);

// Products API
Route::apiResource('products', ProductController::class);

// Clients API
Route::apiResource('clients', ClientController::class);

// Suppliers API
Route::apiResource('suppliers', SupplierController::class);

// Categories API
Route::apiResource('categories', CategoryController::class);
