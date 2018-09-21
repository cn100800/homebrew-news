<?php

namespace app;

use app\client\client;
use app\mail\mail;

require __DIR__ . '/../vendor/autoload.php';
if (!is_dir(__DIR__ . '/../log/')) mkdir(__DIR__ . '/../log/');
$log_path = __DIR__ . '/../log/' . date('Y-m-d_H') . '.log';
$client = new client();
$params = config('home.home.params');
$params['ot'] = time().'000';
$data = $client->get(config('home.home.uri') , config('home.home.path'), $params);
$body = "<html><head><title></title></head><body>";
foreach ($data['Result'] as $value) {
    if (!empty($value['NewsTips'])) {
        $value['NewsTips'][0]['TipName'] = '广告';
        error_log(json_encode($value, JSON_UNESCAPED_UNICODE), 3, $log_path);
        continue;
    }
    $body .= "<h1>${value['title']}</h1><h2>${value['description']}</h2><br />";
}
$body .= "</body></html>";
$mail = new mail();
$mail->mail('home', $body);
