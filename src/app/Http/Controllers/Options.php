<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected $model = Person::class;

    protected $queryAttributes = ['name', 'appellative', 'uid'];
}
