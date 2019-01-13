<?php

namespace LaravelEnso\People\app\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class Genders extends Enum
{
    const Female = 1;
    const Male = 2;

    protected static $data = [
        self::Female => 'female',
        self::Male => 'male',
    ];
}
