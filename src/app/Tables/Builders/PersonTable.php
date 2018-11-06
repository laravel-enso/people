<?php

namespace LaravelEnso\People\app\Tables\Builders;

use LaravelEnso\People\app\Models\Person;
use LaravelEnso\VueDatatable\app\Classes\Table;

class PersonTable extends Table
{
    const TemplatePath = __DIR__.'/../Templates/people.json';

    public function query()
    {
        return Person::select(\DB::raw(
                'people.*, people.id as "dtRowId", CASE WHEN users.id is null THEN 0 ELSE 1 END as user'
            ))->leftJoin('users', 'people.id', '=', 'users.person_id');
    }

    public function templatePath()
    {
        $file = config('enso.people.tableTemplate');
        $templatePath = base_path($file);

        return $file && \File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
