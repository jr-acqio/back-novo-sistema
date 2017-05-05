<?php

Route::group(['middleware' => 'api', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    Route::post('api/authenticate','AuthController@authenticate');
});
