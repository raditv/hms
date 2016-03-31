<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Report\DailySalesContract;
use App\Repositories\Backend\Report\DailySalesOutContract;
use App\Repositories\Backend\Report\ReservationContract;
use DB;
/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    protected $dailySales;
	protected $dailySalesOut;
    protected $reservation;

	public function __construct(
        DailySalesContract $dailySales,
        DailySalesOutContract $dailySalesOut,
        ReservationContract $reservation
    )
    {
        $this->dailySales  = $dailySales;
        $this->dailySalesOut  = $dailySalesOut;
        $this->reservation = $reservation;

    }
    public function dailySalesChart()
    {
        $revenues = $this->dailySales->getTenDaysRevenue();
        $sales = $this->dailySales->getTenDaysAR();
        $salesDataset = array();
        $revenueDataset = array();
        foreach($sales as $key => $sale)
        {
            array_push($salesDataset,array("series"=>$key,
                                           "x"=>strtotime($revenues[$key]->DATEDAILYRPT)*1000,
                                           "y"=>intval($sale->TODAY)));
            array_push($revenueDataset,array("series"=>$key,
                                             "x"=>strtotime($revenues[$key]->DATEDAILYRPT)*1000,
                                             "y"=>intval($revenues[$key]->TODAY)));
        }

        $salesData = array("values"=> $salesDataset,
                           "key"=> "Sales", 
                           "area"=> true);
        $revenuesData = array("values"=> $revenueDataset,
                              "key"=> "Revenue", 
                              "area"=> true);
        $chartData = array($salesData, $revenuesData);
        return response()->json($chartData);       
    }
    public function index()
    {
        $date = date('Y/m/d');
        $salesDataset = array();
        $sales = $this->dailySales->getTenDaysSales();
        $labels = $this->dailySales->getSalesLabel();
        $revenues = $this->dailySales->getTodaySales();
        $label = array();
        $sale = array();
        $chartData = array();
        $data = array();
        foreach($labels as $lbl)
        {
            array_push($label, array(str_replace(' ', '', $lbl->DESCRIPTION)));
        }
        foreach($sales as $key => $sl)
        {
            array_push($sale, array('x'=>strtotime($sl->DATEDAILYRPT)*1000, 'y'=>floatval($sl->TODAY)));
        }
        foreach($revenues as $key => $revenue)
        {
            array_push($data, array("label" => str_replace(' ', '', $revenue->DESCRIPTION),
                                    "value" =>  intval($revenue->TODAY)));
        }
        $cd = array('label'=>$label, 'sales'=>$sale);
        javascript()->put([
            'testChart' => $data,
            'salesData' => chart()->lineChart($cd),
        ]);
        return view('backend.dashboard')
                ->withReservations($this->reservation->generateReport($date));
        
    }
}