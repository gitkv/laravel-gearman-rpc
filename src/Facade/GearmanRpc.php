<?php

namespace gitkv\GearmanRpc\Facade;


use Illuminate\Support\Facades\Facade;

class GearmanRpc extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'gearman-rpc';
    }
}
