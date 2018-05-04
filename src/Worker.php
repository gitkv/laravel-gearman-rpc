<?php

namespace gitkv\GearmanRpc;


class Worker extends \MHlavac\Gearman\Worker {

    public function __construct($host = '127.0.0.1', $port = '4730', $id = null) {
        parent::__construct($id);
        $this->addServer($host, $port);
    }

    public function getClosure(string $callback) {
        $class = new $callback;
        if ($class instanceof HandlerContract === false)
            throw new \Exception('Callback is not instance of ' . HandlerContract::class);

        return function ($arg) use ($class) {
            return $class->handle($arg);
        };
    }

    public function addFunction($functionName, $callback, $timeout = null) {
        return parent::addFunction($functionName, $this->getClosure($callback), $timeout);
    }
}
