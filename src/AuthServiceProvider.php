<?php

namespace LaravelEnso\People;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\People\Models\Person;
use LaravelEnso\People\Policies\Person as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Person::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
