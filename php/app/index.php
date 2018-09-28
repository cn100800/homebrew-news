<?php

namespace app;

use app\client\client;
use app\mail\mail;

init();

$body = "<html><head><title></title></head><body>";
$up_time = time().'000';
while ($have_more) {
    $have_more = false;
    $data = getData($up_time);
    foreach ($data['Result'] as $value) {
        if (date('Y-m-d') != date('Y-m-d', strtotime($value['orderdate']))) {
            continue;
        }
        if (!empty($value['NewsTips'])) {
            $value['NewsTips'][0]['TipName'] = '广告';
            error_log(json_encode($value, JSON_UNESCAPED_UNICODE), 3, $log_path);
            continue;
        }
        $body .= "<h1>${value['title']}</h1><h2>${value['description']}</h2><a href='${value['WapNewsUrl']}'>wap</a><br />";
        $up_time = strtotime($value['orderdate']).'000';
        $have_more = true;
    }
}
// $body .= "</body></html>";
// $mail = new mail();
// $mail->mail(date('Y-m-d'), $body);

function init(){
    global $log_path;
    global $have_more;
    $have_more = true;
    require __DIR__ . '/../vendor/autoload.php';
    if (!is_dir(__DIR__ . '/../log/')) {
        mkdir(__DIR__ . '/../log/');
    }
    $log_path = __DIR__ . '/../log/' . date('Y-m-d_H') . '.log';
    date_default_timezone_set('Asia/Shanghai');
}

function getData($time){
    $params = config('home.home.params');
    $params['ot'] = $time;
    $client = new client();
    return $client->get(config('home.home.uri'), config('home.home.path'), $params);
}
$body .="<hr />";
//$body = "<html><head><title></title></head><body>";
$have_more = true;
$params = config('home.jue.params');
while ($have_more) {
    $have_more = false;
    $client = new client();
    $data = $client->get(config('home.jue.uri'), config('home.jue.path'), $params);
    foreach ($data['d']['list'] as $value) {
        if (date('Y-m-d', strtotime($value['createdAt'])) != date('Y-m-d')) continue;
        $body.="<h2>${value['content']}</h2>";
        if (!empty($value['pictures'])){
            foreach ($value['pictures'] as $img_url) {
                $body.="<img src='${img_url}'/>";
            }
        }
        $body.="<br />";
        $have_more = true;
        $params['before'] = $value['createdAt'];
    }
}
$body .= "</body></html>";
$mail = new mail();
$mail->mail(date('Y-m-d'), $body);

