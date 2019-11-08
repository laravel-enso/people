<?php

namespace LaravelEnso\People;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\People\app\Enums\Genders;
use LaravelEnso\People\app\Enums\Titles;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'genders' => Genders::class,
        'titles' => Titles::class,
    ];
}
