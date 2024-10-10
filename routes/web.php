<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SrinuController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminRegistation;
use App\Http\Controllers\AuthController;

// Company Portfolio
Route::get('/', function () {
    return view('index');
})->name('index');

// Product Routing
Route::domain('{subdomain}.welcomewebworks.com')->group(function () {
    Route::get('/menu', [ProductController::class, 'checkSubdomain'])->name('subdomain.menu');
});

Route::get('/api/menu-items', [ProductController::class, 'getMenuItems']);

// Login Route
Route::get('/login', function () {
    return view('login'); // Display login form
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Admin Registration Route
Route::get('/adminRegistration', function () {
    return view('adminRegistation');
})->name('adminRegistration');
Route::post('/addAdminRegistation', [AdminRegistation::class, 'AdminRegistation'])->name('AdminRegistation');

// Super Admin Routes - Protected by Auth and AutoLogout Middleware
Route::middleware(['auth'])->group(function () {
    // Client Routes
    Route::get('/clientDetails', [SuperAdminController::class, 'clientDetails'])->name('clientDetails');
    Route::get('/addClient', function () {
        return view('addClient');
    })->name('addClient');
    Route::post('/addClient', [SuperAdminController::class, 'addClient'])->name('addClient');
    Route::post('/check-domain', [SuperAdminController::class, 'checkDomain'])->name('check.domain');
    Route::get('/client/{id}/edit', [SuperAdminController::class, 'editClientDetails'])->name('client.editClientDetails');
    Route::post('/client/{id}/update', [SuperAdminController::class, 'updateClientDetails'])->name('client.updateClientDetails');

    // Menu Routes
    Route::get('/menuDetails', [SuperAdminController::class, 'menuDetails'])->name('menuDetails');
    Route::get('/addMenu', function () {
        return view('addMenu');
    })->name('addMenu');
    Route::post('/addMenu', [SuperAdminController::class, 'addMenu'])->name('addMenu');
    Route::delete('/menu/{id}', [SuperAdminController::class, 'destroyMenu'])->name('menu.destroyMenu');
    Route::get('/menu/{id}/edit', [SuperAdminController::class, 'editMenu']);

    // Client Menu Price Routes
    Route::get('/menuPriceDetails', [SuperAdminController::class, 'menuPriceDetails'])->name('menuPriceDetails');
    Route::get('/addClientMenuPrice', [SuperAdminController::class, 'addClientMenuPrice'])->name('addClientMenuPrice');
    Route::post('/submitClientMenuPrice', [SuperAdminController::class, 'submitClientMenuPrice'])->name('submitClientMenuPrice');
});

// Logout Route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




//---------------------------------------------

use App\Http\Controllers\CustomPasswordResetController;

// Show the password reset form
Route::get('password/reset', [CustomPasswordResetController::class, 'showResetForm'])->name('password.custom.reset.form');

// Handle the password reset request
Route::post('password/reset', [CustomPasswordResetController::class, 'reset'])->name('password.custom.reset');
