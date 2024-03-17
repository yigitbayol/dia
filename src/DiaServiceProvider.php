<?php

namespace Yigitbayol\Dia;

use Illuminate\Support\ServiceProvider;
use Yigitbayol\Dia\Providers\ConfigServiceProvider;

class DiaServiceProvider extends ServiceProvider
{
    function boot()
    {

    }

    function register()
    {
        $this->app->register(ConfigServiceProvider::class);
    }
}
