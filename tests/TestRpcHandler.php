<?php

namespace gitkv\GearmanRpc\tests;


use gitkv\GearmanRpc\HandlerContract;

class TestRpcHandler implements HandlerContract {

    public function handle($payload) {
        return [
            'status'  => 'success',
            'payload' => $payload,
        ];
    }

}