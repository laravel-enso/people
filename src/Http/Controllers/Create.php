<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Forms\Builders\PersonForm;

class Create extends Controller
{
    public function __invoke(PersonForm $form)
    {
        return ['form' => $form->create()];
    }
}
