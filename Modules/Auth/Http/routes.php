<?php

Route::group(['middleware' => ['web'], 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    Route::post('api/authenticate','AuthController@authenticate');
});
