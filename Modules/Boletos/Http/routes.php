<?php


Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api', 'namespace' => 'Modules\Boletos\Http\Controllers'], function()
{
    Route::resource('conciliation','ConciliationController',['only'=>'store']);
//    Route::post('boletos/conciliation','BoletosController@processReturn')->name('boletos.conciliation');
});
