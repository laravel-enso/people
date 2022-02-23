<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Tables\Builders\Person;
use LaravelEnso\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = Person::class;
}
