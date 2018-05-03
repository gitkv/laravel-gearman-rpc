<?php

namespace gitkv\GearmanRpc;


interface HandlerContract {

    public function handle($payload);

}