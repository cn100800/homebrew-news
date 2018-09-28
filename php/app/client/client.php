<?php

namespace app\client;

class client
{
    public function post($uri, $params)
    {
        $uri = base64_decode($uri);
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL, $uri);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($params));
        $data = json_decode(curl_exec($client), true);
        curl_close($client);
        return $data;
    }

    public function get($uri, $path, $params)
    {
        $uri = base64_decode($uri);
        $client = curl_init();
        $uri = $uri . $path . '?' . http_build_query($params);
        curl_setopt($client, CURLOPT_URL, $uri);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($client), true);
        curl_close($client);
        return $data;
    }
}
