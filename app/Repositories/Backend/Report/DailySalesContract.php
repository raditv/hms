<?php

namespace App\Repositories\Backend\Report;


interface DailySalesContract
{
    public function generateReport($date);
    public function getTenDaysRevenue();
    public function getTenDaysAR();
    public function getRevenueChild($dt);
}
