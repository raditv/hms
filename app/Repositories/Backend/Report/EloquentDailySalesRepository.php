<?php

namespace App\Repositories\Backend\Report;

use App\Models\Access\Report\DailySales;
use App\Exceptions\GeneralException;


class EloquentDailySalesRepository implements DailySalesContract
{

    public function generateReport($dt)
    {
    	return DailySales::where('DATEDAILYRPT',$dt)
                ->orderBy('NORPT','asc')->get();
    }
    public function getTenDaysRevenue()
    {
    	$lastDay = strtotime("-10 day");
    	return DailySales::whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
    	//return DailySales::whereBetween('DATEDAILYRPT', ['2015/07/01', '2015/07/07'])
    			->where('DESCRIPTION','=> TOTAL REVENUE')
    			->select('DATEDAILYRPT','TODAY','DESCRIPTION')
    			->get();
    }
    public function getTenDaysAR()
    {
    	$lastDay = strtotime("-10 day");
    	return DailySales::whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
    	//return DailySales::whereBetween('DATEDAILYRPT', ['2015/07/01', '2015/07/07'])
    			->where('DESCRIPTION','=> BALANCE (A)-(B)')
    			->select('DATEDAILYRPT','TODAY','DESCRIPTION')
    			->get();
    }
    public function getRevenueChild($dt)
    {
        return DailySales::where('NORPT','>=','20')
                ->where('NORPT','<=','28')
                ->where('DATEDAILYRPT',$dt)
                ->select('DESCRIPTION', 'TODAY','THISMONTH','THISYEAR')
                ->orderBy('NORPT','asc')
                ->get();
    }

}
