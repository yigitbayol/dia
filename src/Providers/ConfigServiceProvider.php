<?php

namespace Yigitbayol\Dia\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Console\Events\CommandFinished;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/dia.php' => config_path('dia.php')
        ], 'dia-config');

        $this->publishes([
            __DIR__ . '/../Migrations' => database_path('migrations')
        ], 'dia-migrations');

        $this->publishes([
            __DIR__ . '/../Models' => app_path('Models')
        ], 'dia-models');
    }
}
