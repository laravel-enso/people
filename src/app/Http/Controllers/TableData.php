<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Data;
use LaravelEnso\People\app\Tables\Builders\PersonTable;

class TableData extends Controller
{
    use Data;

    protected $tableClass = PersonTable::class;
}
