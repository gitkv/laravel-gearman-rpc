<?php

namespace gitkv\GearmanRpc\Examples;


use gitkv\GearmanRpc\HandlerContract;

class ExampleRpcHandler implements HandlerContract {

    public function handle($payload) {
        return [
            'status'  => 'success',
            'payload' => $payload,
        ];
    }
}
