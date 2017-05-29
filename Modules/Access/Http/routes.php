<?php

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Access\Http\Controllers'], function()
{
    Route::resource('user','UserController', ['except'=> ['edit','create'] ]);
    Route::get('teste/{user}','UserController@update');
});
