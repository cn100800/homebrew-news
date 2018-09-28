<?php


return [
    'home' => [
        'uri' => 'aHR0cHM6Ly9tLml0aG9tZS5jb20v',
        'path' => 'api/news/newslistpageget',
        'method' => 'get',
        'params' => [
            'Tag' => '',
            'ot' => '',
            'page' => 0,
        ],
        'format' => <<<home
<h1>
    <a href='%s'>%s</a>
</h1>
<h2>
    %s
</h2>
<br />
home
    ],
    'jue' => [
        'uri' => 'aHR0cHM6Ly9zaG9ydC1tc2ctbXMuanVlamluLmltLw==',
        'path' => 'v1/pinList/recommend',
        'method' => 'get',
        'params' => [
            'uid' => '',
            'device_id' => '',
            'token' => '',
            'src' => 'web',
            'before' => '',
            'limit' => 30,
        ],
        'wap' => 'aHR0cHM6Ly9qdWVqaW4uaW0vcGluLw==',
    ],
];
