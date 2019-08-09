<?php

namespace LaravelEnso\People\app\Tables\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Tables\app\Services\Table;

class PersonTable extends Table
{
    protected const TemplatePath = __DIR__.'/../Templates/people.json';

    public function query()
    {
        return Person::selectRaw('
                people.*, people.id as "dtRowId", CASE WHEN users.id is null THEN 0 ELSE 1 END as "user",
                companies.name as company
            ')->leftJoin('users', 'people.id', '=', 'users.person_id')
            ->leftJoin('company_person', function ($join) {
                $join->on('people.id', '=', 'company_person.person_id')
                    ->where('company_person.is_main', true);
            })->leftJoin('companies', 'company_person.company_id', 'companies.id');
    }

    public function templatePath()
    {
        $file = config('enso.people.tableTemplate');

        $templatePath = base_path($file);

        return $file && File::exists($templatePath)
            ? $templatePath
            : static::TemplatePath;
    }
}
