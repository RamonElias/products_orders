<?php

use App\Models\Record;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/total', function () {
        $orders_total_sum = 0;

        if ($record = Record::latest()->first()) {
            $orders_total_sum = $record->get()[0]->orders_total_sum;
        }

        // var_dump($orders_total_sum);
        // dump($orders_total_sum);

        return view('total', compact('orders_total_sum'));
    })->name('total');

    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');
});
