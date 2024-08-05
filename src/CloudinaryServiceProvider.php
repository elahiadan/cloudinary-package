<?php

namespace Cloudinary\Upload;

use Illuminate\Support\ServiceProvider;

class CloudinaryServiceProvider extends ServiceProvider
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
