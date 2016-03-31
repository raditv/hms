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
    public function getTodaySales($dt)
    {
        return DailySales::where('NORPT','>=','20')
                ->where('NORPT','<=','28')
                ->where('DATEDAILYRPT',$dt)
                ->select('DATEDAILYRPT', 'DESCRIPTION','TODAY')
                ->get();
    }
    public function getTenDaysRevenue()
    {
    	$lastDay = strtotime("-10 day");
    	//return DailySales::whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
    	return DailySales::whereBetween('DATEDAILYRPT', ['2016/03/01', '2016/03/10'])
    			->where('DESCRIPTION','=> TOTAL REVENUE')
    			->select('DATEDAILYRPT','TODAY','DESCRIPTION')
    			->get();
    }
    public function getTenDaysAR()
    {
    	$lastDay = strtotime("-10 day");
    	//return DailySales::whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
    	return DailySales::whereBetween('DATEDAILYRPT', ['2016/03/01', '2016/03/10'])
    			->where('DESCRIPTION','=> BALANCE (A)-(B)')
    			->select('DATEDAILYRPT','TODAY','DESCRIPTION')
    			->get();
    }
    public function getTenDaysSales()
    {
        $lastDay = strtotime("-15 day");
        return DailySales::where('NORPT','>=','20')
                ->where('NORPT','<=','28')
                ->whereBetween('DATEDAILYRPT', [date('Y/m/d', $lastDay), date('Y/m/d')])
                ->select('DATEDAILYRPT', 'DESCRIPTION','TODAY')
                ->get();
    }
    public function getSalesLabel()
    {
        return DailySales::where('NORPT','>=','20')
                ->where('NORPT','<=','28')
                ->where('DATEDAILYRPT','2016/03/01')
                ->select('DESCRIPTION')
                ->get();
    }

}
