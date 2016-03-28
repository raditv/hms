<?php

namespace App\Models\Access\Report;

use Illuminate\Database\Eloquent\Model;

class DailySales extends Model
{
    protected $table;
    protected $connection = 'sqlsrv';
    public function __construct()
    {
    	$this->table = 'RPT_DAILYSALSE';
    }
}
