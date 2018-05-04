<?php

namespace gitkv\GearmanRpc;


class Client extends \MHlavac\Gearman\Client {

    public function __construct($host = '127.0.0.1', $port = '4730', $timeout = 1000) {
        parent::__construct($timeout);

        $this->addServer($host, $port);
    }

    public function doNormal($functionName, $workload, $unique = null) {
        if (is_array($workload) || is_object($workload))
            $workload = json_encode($workload);

        return parent::doNormal($functionName, $workload, $unique);
    }

}