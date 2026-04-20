<?php

namespace LaravelEnso\People\Enums;

use LaravelEnso\Enums\Contracts\Mappable;

enum Gender: int implements Mappable
{
    public const Female = 1;
    public const Male = 2;

    public function map(): string
    {
        return match ($this) {
            self::Female => 'female',
            self::Male => 'male',
        };
    }
}
