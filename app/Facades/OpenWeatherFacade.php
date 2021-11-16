<?php


namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class OpenWeatherFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'OpenWeatherService';
    }
}
