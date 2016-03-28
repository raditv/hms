<?php

namespace App\Models\Access\Report;

use Illuminate\Database\Eloquent\Model;

class DailySalesOut extends Model
{
    protected $table;
    protected $connection = 'sqlsrv';
    public function __construct()
    {
    	$this->table = 'RPT_DAILYSALESOUT';
    }
}
