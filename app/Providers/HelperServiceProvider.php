<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    protected $helpers = [
        'SettingHelper',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->helpers as $helper) {
            require_once(app_path().'/Helpers/'.$helper.'.php');
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
