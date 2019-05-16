<?php

namespace LaravelEnso\People\app\Tables\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Tables\app\Services\Table;

class PersonTable extends Table
{
    const TemplatePath = __DIR__.'/../Templates/people.json';

    public function query()
    {
        return Person::selectRaw('
                people.*, people.id as "dtRowId", CASE WHEN users.id is null THEN 0 ELSE 1 END as "user",
                companies.name as company
            ')->leftJoin('users', 'people.id', '=', 'users.person_id')
            ->leftJoin('companies', 'people.company_id', '=', 'companies.id');
    }

    public function templatePath()
    {
        $file = config('enso.people.tableTemplate');

        $templatePath = base_path($file);

        return $file && File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
