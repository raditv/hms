<?php

namespace App\Http\Controllers\Backend\Access\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Report\DailySalesContract;
use App\Repositories\Backend\Report\DailySalesOutContract;


class ReportController extends Controller
{
	protected $dailySales;
	protected $dailySalesOut;

	public function __construct(
        DailySalesContract $dailySales,
        DailySalesOutContract $dailySalesOut
    )
    {
        $this->dailySales  = $dailySales;
        $this->dailySalesOut  = $dailySalesOut;

    }
    public function dailySales(Request $request)
    {
    	if(count($request['date']))
    	{
    		$date = $request['date'];
    		return view('backend.access.report.dailysales')
    	 	->withSales($this->dailySales->generateReport($date))
    	 	->withDate($date);
    	}
    	else
    	{
    		$date = date('Y/m/d');
    		return view('backend.access.report.dailysales')
    	 	->withSales($this->dailySales->generateReport($date))
    	 	->withDate($date);;
    	}
    	
    }
    public function dailySalesOut(Request $request)
    {
    	if(count($request['date']))
    	{
    		$date = $request['date'];
    		return view('backend.access.report.dailysalesout')
    	 	->withSales($this->dailySalesOut->generateReport($date))
    	 	->withDate($date);
    	}
    	else
    	{
    		$date = date('Y/m/d');
    		return view('backend.access.report.dailysalesout')
    	 	->withSales($this->dailySalesOut->generateReport($date))
    	 	->withDate($date);;
    	}
    	
    }
}