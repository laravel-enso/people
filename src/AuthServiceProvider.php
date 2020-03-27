<?php

namespace LaravelEnso\People;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\People\App\Models\Person;
use LaravelEnso\People\App\Policies\Person as Policy;

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
