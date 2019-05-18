<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\app\Traits\Excel;
use LaravelEnso\People\app\Tables\Builders\PersonTable;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = PersonTable::class;
}
