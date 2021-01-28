<?php

namespace LaravelEnso\People;

use LaravelEnso\Addresses\AddressableServiceProvider as ServiceProvider;
use LaravelEnso\People\Models\Person;

class AddressableServiceProvider extends ServiceProvider
{
    protected array $register = [
        Person::class,
    ];
}
