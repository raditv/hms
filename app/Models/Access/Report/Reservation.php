<?php

namespace App\Models\Access\Report;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table;
    protected $connection = 'sqlsrv';
    public function __construct()
    {
    	$this->table = 'RPT_ROOMSTATISTIC';
    }
}
