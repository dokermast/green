<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


class DateService extends Facade {

    public static function getFacadeAccessor(){

        return 'dateCheck';
    }
}
