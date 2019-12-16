<?php

namespace LaravelEnso\People\app\Enums;

use LaravelEnso\Enums\app\Services\Enum;

class Genders extends Enum
{
    public const Female = 1;
    public const Male = 2;

    protected static $data = [
        self::Female => 'female',
        self::Male => 'male',
    ];
}
