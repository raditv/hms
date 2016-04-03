<?php

Route::group([
    'prefix'     => 'report',
    'namespace'  => 'Access',
    'middleware' => 'access.routeNeedsPermission:view-report',
], function() {

    /**
     * Report Management
     */
    Route::group(['namespace' => 'Report',
                  'prefix' => 'sales'], function() {
        Route::get('dailysales', 'ReportController@dailySales')->name('admin.report.sales.get.dailysales');
        Route::post('dailysales', 'ReportController@dailySales')->name('admin.report.sales.post.dailysales');
        Route::any('dailysales/chart', 'ReportController@dailySalesChart')->name('admin.report.sales.dailysales.chart');

        Route::get('dailysalesout', 'ReportController@dailySalesOut')->name('admin.report.sales.get.dailysalesout');
        Route::post('dailysalesout', 'ReportController@dailySalesOut')->name('admin.report.sales.post.dailysalesout');
    });
});