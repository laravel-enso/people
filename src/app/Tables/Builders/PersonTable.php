<?php

namespace LaravelEnso\People\app\Tables\Builders;

use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Tables\app\Services\Table;

class PersonTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/people.json';

    public function query()
    {
        return Person::selectRaw('
            people.id, people.title, people.name, people.appellative, people.email, people.phone,
            people.birthday, CASE WHEN users.id is null THEN 0 ELSE 1 END as "user",
            companies.name as company, people.created_at
        ')->leftJoin('users', 'people.id', '=', 'users.person_id')
        ->leftJoin('company_person', function ($join) {
            $join->on('people.id', '=', 'company_person.person_id')
                ->where('company_person.is_main', true);
        })->leftJoin('companies', 'company_person.company_id', 'companies.id');
    }
}
