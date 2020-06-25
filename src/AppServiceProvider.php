<?php

namespace LaravelEnso\People;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\People\Models\Person;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish();

        Person::morphMap();
    }

    private function load()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], ['people-factory', 'enso-factories']);
    }
}
