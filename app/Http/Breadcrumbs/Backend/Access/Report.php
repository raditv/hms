<?php

Breadcrumbs::register('admin.access.report.get.dailysales', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Daily Sales', route('admin.access.report.get.dailysales'));
});

Breadcrumbs::register('admin.access.report.get.dailysalesout', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Daily Sales Out', route('admin.access.report.get.dailysalesout'));
});


