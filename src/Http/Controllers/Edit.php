<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Forms\Builders\Person;
use LaravelEnso\People\Models\Person as Model;

class Edit extends Controller
{
    public function __invoke(Model $person, Person $form)
    {
        return ['form' => $form->edit($person)];
    }
}
