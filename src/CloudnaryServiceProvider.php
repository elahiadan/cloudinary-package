<?php

namespace Upload\Cloudenary;

use Illuminate\Support\ServiceProvider;

class CloudenaryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/cloudenary.php' => config_path('cloudenary.php'),
        ]);
    }
    public function register()
    {
    }
}
