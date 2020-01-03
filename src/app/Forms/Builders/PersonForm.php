<?php

namespace LaravelEnso\People\App\Forms\Builders;

use LaravelEnso\Forms\App\Services\Form;
use LaravelEnso\People\App\Models\Person;

class PersonForm
{
    protected const TemplatePath = __DIR__.'/../Templates/person.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form(static::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Person $person)
    {
        if ($person->hasUser()) {
            $this->form->meta(
                'email', 'tooltip', 'Email can only be edited via the user form'
            )->readonly('email');
        }

        return $this->form
            ->value('company', optional($person->company())->id)
            ->append('userId', optional($person->user)->id)
            ->edit($person);
    }
}
