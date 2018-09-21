<?php

namespace app;

use app\client\client;
use app\mail\mail;

require __DIR__ . '/../vendor/autoload.php';


$client = new client();
$params = config('home.home.params');
$params['ot'] = time().'000';
$data = $client->get(config('home.home.uri') , config('home.home.path'), $params);
$body = "<html><head><title></title></head><body>";
foreach ($data['Result'] as $key => $value) {
    $body .= "<h1>${value['title']}</h1><h2>${value['description']}</h2><br />";
}
$body .= "</body></html>";
$mail = new mail();
$mail->mail('home', $body);
