<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class PersonSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Person::class;
}
