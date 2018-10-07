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
                'people.id as "dtRowId", people.title, people.name, people.phone,
                people.appellative, people.email, people.phone, people.birthday, people.gender,
                if(users.id is null, 0, 1) as user, people.created_at'
            ))->leftJoin('users', 'people.id', '=', 'users.person_id');
    }
}
