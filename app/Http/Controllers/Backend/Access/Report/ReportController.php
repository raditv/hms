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
            $data = array();
            $mdata = array();
            $ydata = array();
            $sales = $this->dailySales->getTodaySales($date);
            foreach($sales as $key => $sale)
            {
            array_push($data, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->TODAY)));
            array_push($mdata, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->THISMONTH)));
            array_push($ydata, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->THISYEAR)));
            }
            javascript()->put([
            'dailySales' => $data,
            'monthlySales' => $mdata,
            'yearlySales' => $ydata,
            ]);
    		return view('backend.access.report.dailysales')
    	 	->withSales($this->dailySales->generateReport($date))
    	 	->withDate($date);
    	}
    	else
    	{
    		$date = date('Y/m/d');
            $data = array();
            $mdata = array();
            $ydata = array();
            $sales = $this->dailySales->getTodaySales($date);
            foreach($sales as $key => $sale)
            {
            array_push($data, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->TODAY)));
            array_push($mdata, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->THISMONTH)));
            array_push($ydata, array("label" => str_replace(' ', '', $sale->DESCRIPTION),
                                    "value" =>  intval($sale->THISYEAR)));
            }
            javascript()->put([
            'dailySales' => $data,
            'monthlySales' => $mdata,
            'yearlySales' => $ydata,
            ]);
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