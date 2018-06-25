<?php

namespace Larakit\Auth;

use Illuminate\Support\ServiceProvider;

class LkAuthSimpleServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/auth-simple.php' => config_path('auth-simple.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
