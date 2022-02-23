<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\Tables\Builders\Person;
use LaravelEnso\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = Person::class;
}
