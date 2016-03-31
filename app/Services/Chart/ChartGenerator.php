<?php

namespace App\Services\Chart;

/**
 * Class Dropdowns
 * @package App\Services\Macros
 */
trait ChartGenerator
{
    public function lineChart($chartdata)
    {
        $data = array();
        $sale = $chartdata['sales'];
        $label = $chartdata['label'];
        $slChunk = array_chunk($sale,sizeof($label));
        for ($i = 0; $i < sizeof($label); $i++) {
            $groups[] = array_column($slChunk, $i);
            for($j=0;$j<sizeof($groups[$i]);$j++)
            {
                array_push($groups[$i][$j], $i);
                foreach($groups as $k=>$v)
                {
                    $groups[$k][$j]['series'] = $v[$j][0];
                    //unset($groups[$k][$j][0]);
                }

            }
        }

        foreach($label as $key => $lbl)
        {
            array_push($data, array("values"=> $groups[$key],
                                         "key"=> $lbl[0], 
                                         "area"=> true));
        }
        return $data;
    }
}