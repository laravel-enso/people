<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Forms\Builders\PersonForm;

class Create extends Controller
{
    public function __invoke(PersonForm $form)
    {
        return ['form' => $form->create()];
    }
}
