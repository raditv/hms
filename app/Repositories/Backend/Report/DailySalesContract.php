<?php

namespace App\Repositories\Backend\Report;


interface DailySalesContract
{
    public function generateReport($date);
    public function getTodaySales();
    public function getTenDaysRevenue();
    public function getTenDaysAR();
    public function getTenDaysSales();
    public function getSalesLabel();
}
