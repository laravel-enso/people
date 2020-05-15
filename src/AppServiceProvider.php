<?php

namespace LaravelEnso\People;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\People\App\Models\Person;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->mapMorphs()
            ->publish();
    }

    private function load()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        return $this;
    }

    private function mapMorphs()
    {
        Relation::morphMap([
            Person::morphMapKey() => Person::class,
        ]);

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], ['people-factory', 'enso-factories']);
    }
}
