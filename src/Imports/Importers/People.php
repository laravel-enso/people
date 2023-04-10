<?php

namespace LaravelEnso\People\Imports\Importers;

use LaravelEnso\People\Models\Person;
use LaravelEnso\DataImport\Contracts\Importable;
use LaravelEnso\DataImport\Models\Import;
use LaravelEnso\Helpers\Services\Obj;


class People implements Importable
{
    public function run(Obj $row, Import $import)
    {
        Person::factory()->create($row->toArray());
    }
}
