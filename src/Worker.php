<?php

namespace gitkv\GearmanRpc;


class Worker extends \MHlavac\Gearman\Worker {

    public function __construct($host = '127.0.0.1', $port = '4730', $id = null) {
        parent::__construct($id);
        $this->addServer($host, $port);
    }

    public function getClosure($callback) {
        return function () use ($callback) {
            $class = new $callback;

            return $class->handle();
        };
    }

    public function addFunction($functionName, $callback, $timeout = null) {
        if ($callback instanceof HandlerContract)
            throw new \Exception('Callback is not instance of '.HandlerContract::class);
        $closure = $this->getClosure($callback);
        parent::addFunction($functionName, $closure, $timeout);

        return $this;
    }
}
