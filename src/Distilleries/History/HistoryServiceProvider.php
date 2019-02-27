<?php

namespace Distilleries\History;

use Illuminate\Support\ServiceProvider;

class HistoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../../config/config.php', 'history'
        );
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../config/config.php' => config_path('history.php'),
            __DIR__.'/../../../lang' => resource_path('lang/vendor/history'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../../../lang', 'history');
    }
}
