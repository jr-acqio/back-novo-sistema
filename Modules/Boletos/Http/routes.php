<?php


Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api', 'namespace' => 'Modules\Boletos\Http\Controllers'], function()
{
    Route::post('boletos/conciliation','BoletosController@conciliation')->name('boletos.conciliation');
});
