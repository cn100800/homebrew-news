<?php

namespace app\weather;

use app\client\client;

class weather
{

    public static $week = ['日', '一', '二', '三', '四', '五', '六'];

    public static function getWeather(){
        $client = new client();
        return $client->get(config('home.weather.uri'), config('home.weather.path'), config('home.weather.params'));
    }
}
