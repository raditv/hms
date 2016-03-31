<?php

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
Route::any('update', 'DashboardController@update')->name('admin.update');