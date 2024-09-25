<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SrinuController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProductController;

//Product Routing
Route::get('/{domainName}/menu', [ProductController::class, 'checkDomainName'])->name('domainName');
Route::get('/api/menu-items', [ProductController::class, 'getMenuItems']);



//Super Admin Routing
// Client Route
Route::get('/clientDetails', [SuperAdminController::class, 'clientDetails'])->name('clientDetails');
Route::get('/addClient', function () {
    return view('addClient');
})->name('addClient');
Route::post('/addClient', [SuperAdminController::class, 'addClient'])->name('addClient');
Route::post('/check-domain', [SuperAdminController::class, 'checkDomain'])->name('check.domain');
Route::get('/client/{id}/edit', [SuperAdminController::class, 'editClientDetails'])->name('client.editClientDetails');
Route::post('/client/{id}/update', [SuperAdminController::class, 'updateClientDetails'])->name('client.updateClientDetails');

//Menu Route
Route::get('/menuDetails', [SuperAdminController::class, 'menuDetails'])->name('menuDetails');
Route::get('/addMenu', function () {
    return view('addMenu');
})->name('addMenu');
Route::post('/addMenu', [SuperAdminController::class, 'addMenu'])->name('addMenu');
Route::delete('/menu/{id}', [SuperAdminController::class, 'destroyMenu'])->name('menu.destroyMenu');
Route::get('/menu/{id}/edit', [SuperAdminController::class, 'editMenu']);



//Client Menu Price Route
Route::get('/menuPriceDetails', [SuperAdminController::class, 'menuPriceDetails'])->name('menuPriceDetails');
Route::get('/addClientMenuPrice', [SuperAdminController::class, 'addClientMenuPrice'])->name('addClientMenuPrice');
Route::post('/submitClientMenuPrice', [SuperAdminController::class, 'submitClientMenuPrice'])->name('submitClientMenuPrice');



















// ----------------------------------------------

/* Route::get('/srinuWork', function () {
    return view('srinuWork');
})->name('srinuWork'); */

Route::get('/srinuWork', [SrinuController::class, 'index'])->name('index');
Route::post('/srinuWork', [SrinuController::class, 'create'])->name('create');

Route::get('/srinuWork/edit/{id}', [SrinuController::class, 'edit'])->name('edit');

// Route::put('/client/{id}', [ClientController::class, 'update'])->name('client.update');









