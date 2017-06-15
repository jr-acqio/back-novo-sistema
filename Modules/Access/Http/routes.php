<?php

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'api', 'namespace' => 'Modules\Access\Http\Controllers'], function()
{
    Route::resource('user','UserController', ['except'=> ['edit','create'] ]);
    Route::resource('role','RoleController', ['except'=> ['edit','create'] ]);
});
