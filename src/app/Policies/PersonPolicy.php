<?php

namespace LaravelEnso\People\app\Policies;

use LaravelEnso\Core\app\Models\User;
use LaravelEnso\People\app\Models\Person;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Person $person)
    {
        if ($person->isDirty('email')) {
            return !$person->hasUser();
        }

        return true;
    }
}
