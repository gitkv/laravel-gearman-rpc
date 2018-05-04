<?php

namespace gitkv\GearmanRpc;


use gitkv\GearmanRpc\Console\GearmanRpcCommand;
use Illuminate\Support\ServiceProvider;

class GearmanRpcServiceProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([__DIR__ . '/../config/' => config_path() . '/']);
    }


    public function register() {

        $this->mergeConfigFrom(
            __DIR__ . '/../config/gearman-rpc.php',
            'gearman-rpc'
        );

        $this->app->configure('image');

        $this->app->singleton('command.gearman-rpc', function () {
            return new GearmanRpcCommand();
        });
        $this->commands('command.gearman-rpc');

        $this->app->singleton('gearman-rpc', function () {
            return new Client(
                config('gearman-rpc.host', '127.0.0.1'),
                config('gearman-rpc.port', '4730'),
                config('gearman-rpc.timeout', 1000)
            );
        });

        $this->app->alias('gearman-rpc', Client::class);
    }

}
