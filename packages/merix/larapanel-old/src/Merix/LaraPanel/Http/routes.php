<?php

Route::get('admint', 'Merix\LaraPanel\Controllers\TestController@index');


Route::group(['prefix' => '/{panel}', 'namespace' => 'Merix\LaraPanel\Http\Controllers'], function()
{
    // Create pattern for panel part of route to prevent catching non admin routes
    $panelPattern = '';
    foreach(config('larapanel.panels') as $panelName)
    {
        $domain = config('larapanel-panels.'.$panelName.'.domain');
        $uri = config('larapanel-panels.'.$panelName.'.uri');

        $panelPattern .= '|' . $panelName;
    }
    $panelPattern = '^(' . substr($panelPattern, 1) . ')$';


    //Routes
    Route::get('/', 'AdminController@index')->where('panel', $panelPattern);
    Route::get('/{key}', 'AdminController@get')->where('panel', $panelPattern)->name('larapanel.admin.page');
    Route::get('/{key}/table/data', 'TableController@get')->where('panel', $panelPattern)->name('larapanel.admin.table.data');


});


