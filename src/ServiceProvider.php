<?php

namespace Orbas\Util;

use Illuminate\Support\ServiceProvider as Provider;
use Orbas\Util\Console\EnumMakeCommand;
use Orbas\Util\Console\PresenterMakeCommand;

class ServiceProvider extends Provider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->registerCommands();
        $this->registerEnum();
    }

    protected function registerEnum()
    {
        $this->app->singleton('enum', function ($app) {
            return new Enum('App\\Enums');
        });
    }

    /**
     * Register Commands.
     */
    protected function registerCommands()
    {
        $this->commands([EnumMakeCommand::class, PresenterMakeCommand::class]);
    }

}