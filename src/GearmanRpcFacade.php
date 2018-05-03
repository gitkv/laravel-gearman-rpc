<?php

namespace gitkv\GearmanRpc;


use Illuminate\Support\Facades\Facade;

class GearmanRpcFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'gearman-rpc';
    }
}
