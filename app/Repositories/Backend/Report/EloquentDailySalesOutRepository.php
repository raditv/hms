<?php

namespace App\Repositories\Backend\Report;

use App\Models\Access\Report\DailySalesOut;
use App\Exceptions\GeneralException;


class EloquentDailySalesOutRepository implements DailySalesOutContract
{

    public function generateReport($dt)
    {
            return DailySalesOut::where('DATEDAILYRPT',$dt)
                ->orderBy('NORPT','asc')->get();
    }

    public function getTenDaysChart()
    {
    	$lastDay = strtotime("-10 day");
    	return DailySalesOut::whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
    			->where('DESCRIPTION','-> REVENUE')
    			->select('DATEDAILYRPT','TODAYFOOD','DESCRIPTION')
    			->get();
    }
}
