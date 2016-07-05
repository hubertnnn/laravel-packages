<?php

Route::group(['namespace' => '\Merix\LaraPanel\Backend\Laravel\Http\Controllers'], function()
{
    $panels = [
        'admin',
        'user',
    ];
    $panels = '^(' . implode('|', $panels) . ')$';


    Route::get('/{panel}', 'PanelController@index')->where('panel', $panels)->name('larapanel.index');
    Route::get('/{panel}/__panel', 'PanelController@panel')->where('panel', $panels)->name('larapanel.panel');
    Route::get('/{panel}/__action/{action}', 'PanelController@action')->where('panel', $panels)->name('larapanel.action');

});

