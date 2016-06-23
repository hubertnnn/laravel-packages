<?php

Route::get('admin', 'Merix\LaraPanel\Controllers\AdminController@index')->name('larapanel.index');
Route::get('admin', 'Merix\LaraPanel\Controllers\AdminController@get')->name('larapanel.admin.page');