<?php

namespace LaravelEnso\People\Policies;

use LaravelEnso\People\Models\Person as Model;
use LaravelEnso\Users\Models\User;

class Person
{
    public function before(User $user)
    {
        return $user->isSuperior();
    }

    public function store(User $user, Model $model, array $companies)
    {
        return true;
    }

    public function update(User $user, Model $model, array $companies)
    {
        return true;
    }

    public function destroy(User $user, Model $model)
    {
        return true;
    }
}
