<?php

namespace LaravelEnso\People\app\Policies;

use LaravelEnso\Core\app\Models\User;
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

    public function setCompanies(User $user, Person $person, array $companyIds)
    {
        return collect($companyIds)->diff(
            $user->person->companies()->pluck('id')
        )->isEmpty();
    }
}
