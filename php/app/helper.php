<?php

function config($str){
    $setting = explode('.', $str);
    $array = require __DIR__ . '/../config/' . $setting[0] . '.php';
    unset($setting[0]);
    foreach ($setting as $value) {
        $array = $array[$value];
    }
    return $array;
}
