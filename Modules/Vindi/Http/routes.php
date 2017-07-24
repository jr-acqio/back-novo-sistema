<?php

Route::group(['middleware' => 'web', 'prefix' => 'api/vindi', 'namespace' => 'Modules\Vindi\Http\Controllers'], function()
{
    Route::get('/', 'VindiController@index');
    Route::resource('subscriptions','SubscriptionController');
    Route::resource('bills','BillController');
});
