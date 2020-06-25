<?php

namespace LaravelEnso\People;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\People\Enums\Genders;
use LaravelEnso\People\Enums\Titles;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'genders' => Genders::class,
        'titles' => Titles::class,
    ];
}
