<?php

Route::group(['namespace' => '\Merix\LaraPanel\Backend\Laravel\Http\Controllers'], function()
{
    $larapanel = \App::make('Merix\LaraPanel\Core\Contracts\Modules\LaraPanel');

    $panels = $larapanel->getConfig()->getArray('larapanel.panels');
    $panels = '^(' . implode('|', $panels) . ')$';


    Route::get('/{panel}', 'PanelController@index')->where('panel', $panels)->name('larapanel.index');
    Route::get('/{panel}/__panel', 'PanelController@panel')->where('panel', $panels)->name('larapanel.panel');
    Route::get('/{panel}/__action/{action}', 'PanelController@action')->where('panel', $panels)->name('larapanel.panel.action');

    Route::get('/{panel}/{admin}/__admin', 'AdminController@admin')->where('panel', $panels)->name('larapanel.admin');
    Route::get('/{panel}/{admin}/__action/{action}', 'AdminController@action')->where('panel', $panels)->name('larapanel.admin.action');
    Route::get('/{panel}/{admin}/__edit', 'AdminController@edit')->where('panel', $panels)->name('larapanel.admin.edit');
    Route::get('/{panel}/{admin}/{id}', 'AdminController@get')->where('panel', $panels)->name('larapanel.admin.get');
    Route::post('/{panel}/{admin}/{id}/__store', 'AdminController@store')->where('panel', $panels)->name('larapanel.admin.store');

});

