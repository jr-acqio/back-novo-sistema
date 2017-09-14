<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $bank_billets = BoletoSimples\BankBillet::all(['page' => 1, 'per_page' => 50]);
    foreach($bank_billets as $bank_billet) {
        dd($bank_billet->attributes());
    }
    return view('index');
});

// Auth::routes();
