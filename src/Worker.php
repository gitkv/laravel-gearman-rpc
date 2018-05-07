<?php

namespace gitkv\GearmanRpc;


class Worker extends \MHlavac\Gearman\Worker {

    public function __construct($host = '127.0.0.1', $port = '4730', $id = null) {
        parent::__construct($id);
        $this->addServer($host, $port);
    }

    protected function isImplementHandle($class) {
        $interfaceList = class_implements($class);
        if ($interfaceList)
            foreach ($interfaceList as $interface) {
                if ($interface === HandlerContract::class)
                    return true;
            }

        return false;
    }

    public function getClosure(string $callback) {
        if (!$this->isImplementHandle($callback))
            throw new \Exception('Callback is not instance of ' . HandlerContract::class);

        return function ($arg) use ($callback) {
            $class = new $callback;

            return json_encode($class->handle($arg));
        };
    }

    public function addFunction($functionName, $callback, $timeout = null) {
        return parent::addFunction($functionName, $this->getClosure($callback), $timeout);
    }
}
