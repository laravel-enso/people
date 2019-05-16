<?php

namespace LaravelEnso\People\app\Policies;

use LaravelEnso\People\app\Models\Person;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->belongsToAdminGroup()) {
            return true;
        }
    }

    public function setCompany($user, Person $person)
    {
        return $user->person->company_id === null
            || $user->person->company_id === $person->company_id;
    }

    public function changeCompany($user, Person $person)
    {
        return false;
    }
}
