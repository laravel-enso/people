<?php

namespace LaravelEnso\People;

use LaravelEnso\People\App\Models\Person;
use LaravelEnso\Searchable\SearchServiceProvider as ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public $register = [
        Person::class => [
            'group' => 'Person',
            'attributes' => ['name', 'appellative', 'email', 'phone'],
            'label' => 'name',
            'permissionGroup' => 'administration.people',
        ],
    ];
}
