<?php

namespace gitkv\GearmanRpc;


class Worker extends \MHlavac\Gearman\Worker {

    public function __construct($id = null) {
        parent::__construct($id);
        $this->addServer(config('gearman-rpc.host', '127.0.0.1'), config('gearman-rpc.port', '4730'));
    }

    public function addFunction(string $functionName, HandlerContract $callback, $timeout = null) {
        $function = function () use ($callback) {
            $class = new $callback;

            return $class->handle();
        };
        parent::addFunction($functionName, $function, $timeout = null);
    }
}
