<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.index');
});
Route::get('customer/trash', [CustomerController::class, 'trashIndex'])->name('customer.trash'); 
Route::get('customer/reestore/{customer}', [CustomerController::class, 'reestoreIndex'])->name('customer.restore');
Route::get('customer/trash.{customer}', [CustomerController::class, 'forceDestroy'])->name('customer.forceDestroy');
Route::resource('customer', CustomerController::class);
