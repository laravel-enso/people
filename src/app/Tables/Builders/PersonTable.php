<?php

namespace LaravelEnso\People\app\Tables\Builders;

use LaravelEnso\People\app\Models\Person;
use LaravelEnso\VueDatatable\app\Classes\Table;

class PersonTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/people.json';

    public function query()
    {
        return Person::select(\DB::raw(
                'people.*, people.id as "dtRowId", if(users.id is null, 0, 1) as user'
            ))->leftJoin('users', 'people.id', '=', 'users.person_id');
    }
}
