<?php

namespace LaravelEnso\People\Traits;

trait IsPerson
{
    public static function bootIsPerson()
    {
        self::updated(fn ($model) => $model->cascadeEmailUpdate());

        self::created(fn ($model) => $model->cascadeEmailUpdate());
    }

    private function cascadeEmailUpdate()
    {
        if ($this->isDirty('email')) {
            $this->person->update(['email' => $this->email]);
        }
    }
}
