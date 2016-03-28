<?php

namespace App\Repositories\Backend\Report;


interface ReservationContract
{
    public function generateReport($date);
}
