<?php

return [
    'url'=>env('AIN_URL','http://ain.test'),
    'key'=>env('AIN_KEY'),
    'cache'=>[
      'type'=>env('AIN_CACHE_TYPE','remote'),
      'local_ttl'=>180
    ],
    'mock'=>[
        'type'=>env('AIN_MOCK_TYPE','none')
    ]
];
