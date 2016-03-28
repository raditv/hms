<?php

namespace App\Repositories\Backend\Report;

use App\Models\Access\Report\Reservation;
use App\Exceptions\GeneralException;


class EloquentReservationRepository implements ReservationContract
{

    public function generateReport($dt)
    {
    	return Reservation::where('TGLREPORT',$dt)
                ->where('NORPT','>=','4')
                ->where('NORPT','<=','13')
                ->select('TGLREPORT','TODAY','DESCRIPTION')
                ->orderBy('NORPT','asc')->get();
    }

}
