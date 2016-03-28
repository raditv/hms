<?php

namespace App\Repositories\Backend\Report;


interface DailySalesOutContract
{
    public function generateReport($date);
    public function getTenDaysChart();
}
