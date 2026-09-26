<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/purchase-orders', [
        PurchaseOrderController::class,
        'index'
    ])->name('purchase-orders.index');

    Route::get('/purchase-orders/create', [
        PurchaseOrderController::class,
        'create'
    ])->name('purchase-orders.create');

    Route::post('/purchase-orders', [
        PurchaseOrderController::class,
        'store'
    ])->name('purchase-orders.store');

    Route::patch('/purchase-orders/{purchaseOrder}/status', [
        PurchaseOrderController::class,
        'updateStatus'
    ])->name('purchase-orders.update-status');

    Route::get('/purchase-orders/{purchaseOrder}/download', [
        PurchaseOrderController::class,
        'download'
    ])->name('purchase-orders.download');

    Route::get('/quotations', [
        QuotationController::class,
        'index'
    ])->name('quotations.index');

    Route::get('/quotations/create', [
        QuotationController::class,
        'create'
    ])->name('quotations.create');

    Route::post('/quotations', [
        QuotationController::class,
        'store'
    ])->name('quotations.store');

    Route::get('/quotations/{quotation}/download/word', [
        QuotationController::class,
        'downloadWord'
    ])->name('quotations.download-word');

    Route::get('/quotations/{quotation}/download/pdf', [
        QuotationController::class,
        'downloadPdf'
    ])->name('quotations.download-pdf');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
