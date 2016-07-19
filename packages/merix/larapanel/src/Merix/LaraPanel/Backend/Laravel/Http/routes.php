<?php

Route::group(['namespace' => '\Merix\LaraPanel\Backend\Laravel\Http\Controllers'], function()
{
    $larapanel = \App::make('Merix\LaraPanel\Core\Contracts\LaraPanel');

    $panels = $larapanel->getConfig()->getArray('larapanel.panels');
    $panels = '^(' . implode('|', $panels) . ')$';


    Route::get('/{panel}', 'PanelController@index')->where('panel', $panels)->name('larapanel.index');
    Route::get('/{panel}/__panel', 'PanelController@panel')->where('panel', $panels)->name('larapanel.panel');
    Route::get('/{panel}/__action/{action}', 'PanelController@action')->where('panel', $panels)->name('larapanel.action');

    Route::get('/{panel}/{admin}/__admin', 'AdminController@admin')->where('panel', $panels)->name('larapanel.action');

});

