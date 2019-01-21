<?php

namespace LaravelEnso\People;

use LaravelEnso\People\app\Models\Person;
use LaravelEnso\People\app\Policies\PersonPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Person::class => PersonPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
