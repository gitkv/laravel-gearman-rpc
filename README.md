Laravel Gearman rpc
===================

[![Build Status](https://travis-ci.org/gitkv/laravel-gearman-rpc.svg?branch=master)](https://travis-ci.org/gitkv/laravel-gearman-rpc)

Laraval / Lumen Gearman Remote Procedure Call

Requires:
* Laravel / Lumen >=5.5/
* PHP >= 7.1
* Gearman PHP-extension


Installation
------------
* Run:
```code
composer require "gitkv/laravel-gearman-rpc"
```
* Install gearman job server as PHP-extension: http://gearman.org/getting-started/#gearman_php_extension<br />
* Install supervisor:
```bash
apt-get install supervisor
```

Configuration
-------------
### Laravel:
Add service provider to /config/app.php:
```php
'providers' => [
    gitkv\GearmanRpc\GearmanRpcServiceProvider::class
],
'aliases' => [
    'GearmanRpc' => gitkv\GearmanRpc\GearmanRpcFacade::class,
],
```

Publish `config/gearman-rpc.php`
```bash
php artisan vendor:publish --provider="gitkv\GearmanRpc\GearmanRpcServiceProvider" --tag=config
```


Usage
-----
### Worker:
#### Create handler:
Create a file in the directory `app\Rpc\MyRpcHandler.php`
```php
<?php

namespace App\Rpc;


use gitkv\GearmanRpc\HandlerContract;

class MyRpcHandler implements HandlerContract {

    public function handle($payload) {
        return [
            'status'  => 'success',
            'payload' => $payload,
        ];
    }

}
```

Add your handler to the `handlers` section in the `config/gearman-rpc.php` file

```php
'MyExampleFunction' => \App\Rpc\MyRpcHandler::class,
```

#### Configure supervisor
Example supervisor config

```bash
[program:app-rpc-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/app/artisan gearman-rpc
autostart=true
autorestart=true
user = www
numprocs=1
redirect_stderr=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
``` 

#### Client:
Synch call
```php
<?php
$result = GearmanRpc::doNormal('MyExampleFunction', json_encode(['test'=>'data']));
```

Asynch call
```php
<?php
GearmanRpc::doBackground('MyExampleFunction', json_encode(['test'=>'data']));
```