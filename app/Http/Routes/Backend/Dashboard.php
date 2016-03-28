<?php

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
Route::any('dailysaleschart', 'DashboardController@dailySalesChart')->name('admin.dailysaleschart');
Route::any('dailyrevenue', 'DashboardController@dailyRevenueChart')->name('admin.dailyrevenuechart');
Route::any('monthlyrevenue', 'DashboardController@monthlyRevenueChart')->name('admin.monthlyrevenuechart');
Route::any('yearlyrevenue', 'DashboardController@yearlyRevenueChart')->name('admin.yearlyrevenuechart');