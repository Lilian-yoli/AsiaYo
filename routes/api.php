<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\OrdersController;

Route::post('/orders', [OrdersController::class, 'index'])->name('orders.index');