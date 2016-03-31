<?php

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
Route::any('dailysaleschart', 'DashboardController@dailySalesChart')->name('admin.dailysaleschart');