<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\VueDatatable\app\Traits\Excel;
use LaravelEnso\VueDatatable\app\Traits\Datatable;
use LaravelEnso\People\app\Tables\Builders\PersonTable;

class PersonTableController extends Controller
{
    use Datatable, Excel;

    protected $tableClass = PersonTable::class;
}
