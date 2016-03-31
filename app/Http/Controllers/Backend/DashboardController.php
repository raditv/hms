<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Report\DailySalesContract;
use App\Repositories\Backend\Report\DailySalesOutContract;
use App\Repositories\Backend\Report\ReservationContract;
use Illuminate\Http\Request;
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
    public function update()
    {
        return access()->update();  
    }
    public function index()
    {
        $date = date('Y/m/d',strtotime("-1 day"));
        $salesDataset = array();
        $sales = $this->dailySales->getTenDaysSales();
        $labels = $this->dailySales->getSalesLabel();
        $revenues = $this->dailySales->getTodaySales($date);
        $label = array();
        $sale = array();
        $data = array();
        $mdata = array();
        $ydata = array();
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
            array_push($mdata, array("label" => str_replace(' ', '', $revenue->DESCRIPTION),
                                    "value" =>  intval($revenue->THISMONTH)));
            array_push($ydata, array("label" => str_replace(' ', '', $revenue->DESCRIPTION),
                                    "value" =>  intval($revenue->THISYEAR)));
        }
        $cd = array('label'=>$label, 'sales'=>$sale);
        javascript()->put([
            'dailySales' => $data,
            'monthlySales' => $mdata,
            'yearlySales' => $ydata,
            'salesData' => chart()->lineChart($cd),
        ]);
        return view('backend.dashboard')
                ->withReservations($this->reservation->generateReport($date));
        
    }
}