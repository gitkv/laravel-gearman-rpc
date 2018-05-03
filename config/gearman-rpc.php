<?php
return [
    'host'     => env('GEARMAN_HOST', '127.0.0.1'),
    'port'     => env('GEARMAN_PORT', 4730),
    'timeout'  => env('GEARMAN_TIMEOUT', 1000),
    'handlers' => [
        'ExampleFunction' => \gitkv\GearmanRpc\Examples\ExampleRpcHandler::class,
    ],
];