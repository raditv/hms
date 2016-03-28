<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Report\DailySalesContract;
use App\Repositories\Backend\Report\DailySalesOutContract;
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

	public function __construct(
        DailySalesContract $dailySales,
        DailySalesOutContract $dailySalesOut
    )
    {
        $this->dailySales  = $dailySales;
        $this->dailySalesOut  = $dailySalesOut;

    }

    public function dailySalesChart()
    {

    	$revenues = $this->dailySales->getTenDaysRevenue();
    	$sales = $this->dailySales->getTenDaysAR();
    	$labels = array();
    	$revenueDataset = array();
    	$salesDataset = array();
    	foreach($sales as $sale)
    	{
    		array_push($salesDataset, $sale->TODAY);
    	}
    	foreach($revenues as $revenue)
    	{
    		array_push($labels, date('d/m/y', strtotime($revenue->DATEDAILYRPT)));
    		array_push($revenueDataset, $revenue->TODAY);
    	}
    	$chartData = array('labels'=>$labels, 'datasets'=> array (
            array('label'=> "Last 10 Days Revenue",
                'fillColor'=> "rgba(220,220,220,0.2)",
                'strokeColor'=> "rgba(220,220,220,1)",
                'pointColor' => "rgba(220,220,220,1)",
                'pointStrokeColor' => "#fff",
            	'pointHighlightFill' => "#fff",
            	'pointHighlightStroke' => "rgba(220,220,220,1)",
                'data' => $revenueDataset),
            array('label'=> "Last 10 Days Account Receiveable",
                'fillColor'=> "rgba(151,187,205,0.2)",
                'strokeColor'=> "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
            	'pointHighlightFill' => "#fff",
            	'pointHighlightStroke' => "rgba(151,187,205,1)",
                'data' => $salesDataset)

        ));
        return response()->json($chartData);       
    }
    public function dailyRevenueChart()
    {

        $date = date('Y/m/d');
        $fakedate = '2016/03/22';
        $data = array();
        $revenues = $this->dailySales->getRevenueChild($date);

        $color = array("rgb(50,205,50)","rgb(100,149,237)","rgb(255,105,180)","rgb(186,85,211)","rgb(205,92,92)","rgb(255,165,0)","rgb(64,224,208)","rgb(30,144,255)","rgb(255,99,71)");
        $highlight = array("rgba(50,205,50,1)","rgba(100,149,237,1)","rgba(255,105,180,1)","rgba(186,85,211,1)","rgba(205,92,92,1)","rgba(255,165,0,1)","rgba(64,224,208,1)","rgba(30,144,255,1)","rgba(255,99,71,1)");
        foreach($revenues as $key => $revenue)
        {
            array_push($data, array('value' => $revenue->TODAY,
                                    'color' => $color[$key],
                                    'highlight' => $highlight[$key],
                                    'label' => str_replace(' ', '', $revenue->DESCRIPTION)));
        }
        return response()->json($data);
              
    }
    public function monthlyRevenueChart()
    {

        $date = date('Y/m/d');
        $fakedate = '2016/03/22';
        $data = array();
        $revenues = $this->dailySales->getRevenueChild($date);

        $color = array("rgb(50,205,50)","rgb(100,149,237)","rgb(255,105,180)","rgb(186,85,211)","rgb(205,92,92)","rgb(255,165,0)","rgb(64,224,208)","rgb(30,144,255)","rgb(255,99,71)");
        $highlight = array("rgba(50,205,50,1)","rgba(100,149,237,1)","rgba(255,105,180,1)","rgba(186,85,211,1)","rgba(205,92,92,1)","rgba(255,165,0,1)","rgba(64,224,208,1)","rgba(30,144,255,1)","rgba(255,99,71,1)");
        foreach($revenues as $key => $revenue)
        {
            array_push($data, array('value' => $revenue->THISMONTH,
                                    'color' => $color[$key],
                                    'highlight' => $highlight[$key],
                                    'label' => str_replace(' ', '', $revenue->DESCRIPTION)));
        }
        return response()->json($data);
              
    }
    public function yearlyRevenueChart()
    {

        $date = date('Y/m/d');
        $fakedate = '2016/03/22';
        $data = array();
        $revenues = $this->dailySales->getRevenueChild($date);

        $color = array("rgb(50,205,50)","rgb(100,149,237)","rgb(255,105,180)","rgb(186,85,211)","rgb(205,92,92)","rgb(255,165,0)","rgb(64,224,208)","rgb(30,144,255)","rgb(255,99,71)");
        $highlight = array("rgba(50,205,50,1)","rgba(100,149,237,1)","rgba(255,105,180,1)","rgba(186,85,211,1)","rgba(205,92,92,1)","rgba(255,165,0,1)","rgba(64,224,208,1)","rgba(30,144,255,1)","rgba(255,99,71,1)");
        foreach($revenues as $key => $revenue)
        {
            array_push($data, array('value' => $revenue->THISYEAR,
                                    'color' => $color[$key],
                                    'highlight' => $highlight[$key],
                                    'label' => str_replace(' ', '', $revenue->DESCRIPTION)));
        }
        return response()->json($data);
              
    }
    public function index()
    {
        $date = date('Y/m/d');
        $fakedate = '2016/03/22';
        $data = array();
        $revenues = $this->dailySales->getRevenueChild($fakedate);

        $color = array("rgb(50,205,50)","rgb(100,149,237)","rgb(255,105,180)","rgb(186,85,211)","rgb(205,92,92)","rgb(255,165,0)","rgb(64,224,208)","rgb(30,144,255)","rgb(255,99,71)");
        $highlight = array("rgba(50,205,50,1)","rgba(100,149,237,1)","rgba(255,105,180,1)","rgba(186,85,211,1)","rgba(205,92,92,1)","rgba(255,165,0,1)","rgba(64,224,208,1)","rgba(30,144,255,1)","rgba(255,99,71,1)");
        foreach($revenues as $key => $revenue)
        {
            array_push($data, array('value' => $revenue->TODAY,
                                    'color' => $color[$key],
                                    'highlight' => $highlight[$key],
                                    'label' => str_replace(' ', '', $revenue->DESCRIPTION)));
        }
        javascript()->put([
            'dailyRevenue' => $data,
        ]);
        return view('backend.dashboard');
    }
}