<?php

namespace LaravelEnso\People\app\Traits;

trait IsPerson
{
    protected static function bootIsPerson()
    {
        self::updating(function ($model) {
            if ($model->isDirty('email')) {
                $model->person->update(['email' => $model->email]);
            }
        });

        self::creating(function ($model) {
            if ($model->isDirty('email')) {
                $model->person->update(['email' => $model->email]);
            }
        });
    }
}
