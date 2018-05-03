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
            return new Client();
        });

        $this->app->alias('gearman-rpc', Client::class);
    }

}
