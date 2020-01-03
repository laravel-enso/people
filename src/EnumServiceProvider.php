<?php

namespace LaravelEnso\People;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\People\App\Enums\Genders;
use LaravelEnso\People\App\Enums\Titles;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'genders' => Genders::class,
        'titles' => Titles::class,
    ];
}
