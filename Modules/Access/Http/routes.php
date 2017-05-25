<?php

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'access', 'namespace' => 'Modules\Access\Http\Controllers'], function()
{
    Route::resource('user','UserController');
});
