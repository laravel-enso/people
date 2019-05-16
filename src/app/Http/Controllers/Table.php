<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\Tables\app\Traits\Datatable;
use LaravelEnso\People\app\Tables\Builders\PersonTable;

class Table extends Controller
{
    use Datatable, Excel;

    protected $tableClass = PersonTable::class;
}
