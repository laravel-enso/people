<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Models\Person;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Person $person)
    {
        $this->authorize('destroy', $person);

        $person->delete();

        return [
            'message' => __('The person was successfully deleted'),
            'redirect' => 'administration.people.index',
        ];
    }
}
