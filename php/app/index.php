<?php

namespace app;

use app\client\client;

require __DIR__ . '/../vendor/autoload.php';

$client = new client();
$params = config('home.home.params');
$params['ot'] = time().'000';
$data = $client->get(config('home.home.uri') , config('home.home.path'), $params);
var_dump($data);

