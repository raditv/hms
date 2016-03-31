<?php

namespace App\Services\Chart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Chart
 * @package App\Services\Chart\Facades
 */
class Chart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chart';
    }
}