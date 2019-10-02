<?php

namespace LaravelEnso\People;

use LaravelEnso\People\app\Enums\Titles;
use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'genders' => Genders::class,
        'titles' => Titles::class,
    ];
}
