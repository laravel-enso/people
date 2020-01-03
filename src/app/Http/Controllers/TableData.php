<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Tables\Builders\PersonTable;
use LaravelEnso\Tables\App\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected $tableClass = PersonTable::class;
}
