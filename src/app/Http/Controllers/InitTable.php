<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Init;
use LaravelEnso\People\app\Tables\Builders\PersonTable;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = PersonTable::class;
}
