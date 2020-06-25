<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Forms\Builders\PersonForm;
use LaravelEnso\People\Models\Person;

class Edit extends Controller
{
    public function __invoke(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }
}
