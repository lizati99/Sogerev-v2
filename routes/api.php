<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CashRegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\DeviController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\OrderDraftController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SaleOrderController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('permission:manage_users')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    // Route::middleware('permission:view_reports')->group(function () {
    //     Route::get('/reports', 'ReportController@index');
    // });
});
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/users', [UserController::class, 'index']);
//     Route::get('/users/{user}', [UserController::class, 'show']);
//     Route::get('/roles', [RoleController::class, 'index']);
//     Route::get('/permissions', [PermissionController::class, 'index']);
// });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//roles API
Route::apiResource('roles', RoleController::class);

// users API
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('users', UserController::class);
// });

//payment type
Route::apiResource('payment-types', PaymentTypeController::class);

// permissions API
Route::apiResource('permissions', PermissionController::class);

// Categories API
Route::apiResource('categories', CategoryController::class);

// SubCategory API
Route::apiResource('subcategories', SubCategoryController::class);

// Products API
Route::apiResource('products', ProductController::class);

// Suppliers API
Route::apiResource('suppliers', SupplierController::class);

// entreprise
Route::apiResource('entreprises', EntrepriseController::class);

// stock API
Route::apiResource('stocks', StockController::class);

// purchase order API (commande Achat)
Route::apiResource('purchases', PurchaseOrderController::class);

// cash register API (caisse)
Route::apiResource('cash-registers', CashRegisterController::class);

// reception API
Route::apiResource('receptions', ReceptionController::class);

// Clients API
Route::apiResource('clients', ClientController::class);

// sale order API (commande Vente)
Route::apiResource('sales', SaleOrderController::class);

// devis API
Route::apiResource('devis', DeviController::class);

// order draft API (bon de commande)
Route::apiResource('drafts', OrderDraftController::class);

// delivery API (bon de livraison)
Route::apiResource('deliveries', DeliveryController::class);

// invoice API (facture)
Route::apiResource('invoices', InvoiceController::class);


