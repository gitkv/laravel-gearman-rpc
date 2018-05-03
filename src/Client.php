<?php

namespace gitkv\GearmanRpc;


class Client extends \MHlavac\Gearman\Client {

    public function __construct() {
        parent::__construct(config('gearman-rpc.timeout', 1000));

        $this->addServer(config('gearman-rpc.host', '127.0.0.1'), config('gearman-rpc.port', '4730'));
    }

}