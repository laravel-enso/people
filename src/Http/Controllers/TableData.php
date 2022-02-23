<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Tables\Builders\Person;
use LaravelEnso\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected $tableClass = Person::class;
}
