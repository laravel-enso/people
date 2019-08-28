<?php

namespace LaravelEnso\People;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\People\app\Enums\Genders;

class EnumServiceProvider extends ServiceProvider
{
    protected $register=[
        'genders' => Genders::class
    ];
}
