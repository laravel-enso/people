<?php

namespace LaravelEnso\People\Imports\Importers;

use LaravelEnso\DataImport\Contracts\Importable;
use LaravelEnso\DataImport\Models\Import;
use LaravelEnso\Helpers\Services\Obj;
use LaravelEnso\People\Models\Person as Model;

class Person implements Importable
{
    public function run(Obj $row, Import $import)
    {
        Model::factory()->create($row->toArray());
    }
}
