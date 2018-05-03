<?php

namespace gitkv\GearmanRpc\Console;


use gitkv\GearmanRpc\Worker;

class GearmanRpcCommand extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gearman-rpc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Gearman RPC Worker';

    protected $worker = null;

    /**
     * Execute the console command.
     * Request user supervisor config set.
     */
    public function handle() {
        $this->worker = new Worker();
        foreach (config('gearman-rpc.handlers') as $handlerName => $handler) {
            $this->worker->addFunction($handlerName, $handler);
        }

        $this->worker->work();
    }

}
