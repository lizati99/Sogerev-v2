<?php

use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//roles API
Route::apiResource('roles', RoleController::class);

// users API
Route::apiResource('users', UserController::class);

//payment type
Route::apiResource('payment-types', PaymentTypeController::class);

// permissions API
Route::apiResource('permissions', PermissionController::class);

// Categories API
Route::apiResource('categories', CategoryController::class);

// Products API
Route::apiResource('products', ProductController::class);

// Suppliers API
Route::apiResource('suppliers', SupplierController::class);

// entreprise
Route::apiResource('enterprises', EntrepriseController::class);

// stock API
Route::apiResource('stocks', StockController::class);

// purchase order API
Route::apiResource('purchases', PurchaseOrderController::class);

// cash register API
Route::apiResource('cash-registers', CashRegisterController::class);

// reception API
Route::apiResource('receptions', ReceptionController::class);

// sale order API
// Route::apiResource('sales', SaleOrderController::class);

// // devis API
// Route::apiResource('devis', DeviController::class);

// // order draft API
// Route::apiResource('drafts', OrderDraftController::class);

// // delivery API
// Route::apiResource('deliveries', DeliveryController::class);

// // invoice API
// Route::apiResource('invoices', InvoiceController::class);
// Clients API
Route::apiResource('clients', ClientController::class);


