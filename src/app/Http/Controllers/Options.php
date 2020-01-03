<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Models\Person;
use LaravelEnso\Select\App\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected $model = Person::class;

    protected $queryAttributes = ['name', 'appellative', 'uid', 'phone'];
}
