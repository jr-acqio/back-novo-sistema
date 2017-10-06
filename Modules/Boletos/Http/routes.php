<?php


Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Boletos\Http\Controllers'], function()
{
    Route::resource('conciliation','ConciliationController',['only'=>'store']);
//    Route::post('boletos/conciliation','BoletosController@processReturn')->name('boletos.conciliation');
    Route::resource('boleto-simples', 'BoletoSimplesController', ['only'=> ['store','index']]);
});
