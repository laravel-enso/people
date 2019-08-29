<?php

namespace LaravelEnso\People;

use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    protected $register = [
        'genders' => Genders::class,
    ];
}
