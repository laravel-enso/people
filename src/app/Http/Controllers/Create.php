<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Forms\Builders\PersonForm;

class Create extends Controller
{
    public function __invoke(PersonForm $form)
    {
        return ['form' => $form->create()];
    }
}
