<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Forms\Builders\PersonForm;
use LaravelEnso\People\app\Models\Person;

class Edit extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }
}
