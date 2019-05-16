<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\People\app\Forms\Builders\PersonForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }
}
