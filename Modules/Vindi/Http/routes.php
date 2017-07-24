<?php

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api/vindi', 'namespace' => 'Modules\Vindi\Http\Controllers'], function()
{
    Route::get('/', 'VindiController@index');
    Route::resource('subscriptions','SubscriptionController');
    Route::resource('bills','BillController');
});
