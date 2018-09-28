<?php

namespace app;

use app\client\client;
use app\mail\mail;

require __DIR__ . '/../vendor/autoload.php';
if (!is_dir(__DIR__ . '/../log/')) mkdir(__DIR__ . '/../log/');
$log_path = __DIR__ . '/../log/' . date('Y-m-d_H') . '.log';
$client = new client();
$params = config('home.home.params');
date_default_timezone_set('Asia/Shanghai');
$params['ot'] = time().'000';

$body = "<html><head><title></title></head><body>";
$have_more = true;
while ($have_more) {
    $have_more = false;
    $data = $client->get(config('home.home.uri') , config('home.home.path'), $params);
    foreach ($data['Result'] as $value) {
        if (date('Y-m-d') != date('Y-m-d', strtotime($value['orderdate']))) continue;
        if (!empty($value['NewsTips'])) {
            $value['NewsTips'][0]['TipName'] = '广告';
            error_log(json_encode($value, JSON_UNESCAPED_UNICODE), 3, $log_path);
            continue;
        }
        $body .= "<h1>${value['title']}</h1><h2>${value['description']}</h2><br />";
        $params['ot'] = strtotime($value['orderdate']).'000';
        $have_more = true;
    }
}
$body .= "</body></html>";
$mail = new mail();
$mail->mail(date('Y-m-d'), $body);
