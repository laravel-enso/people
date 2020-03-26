<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Tables\Builders\PersonTable;
use LaravelEnso\Tables\App\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = PersonTable::class;
}
