<?php

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api', 'namespace' => 'Modules\Boletos\Http\Controllers'], function()
{
//    Route::resource('boletos', 'BoletosController', ['only'=>'store']);
    Route::post('boletos/conciliation','BoletosController@conciliation')->name('boletos.conciliation');
});
