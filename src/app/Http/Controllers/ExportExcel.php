<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Tables\Builders\PersonTable;
use LaravelEnso\Tables\App\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = PersonTable::class;
}
