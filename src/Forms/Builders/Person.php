<?php

namespace LaravelEnso\People\Forms\Builders;

use LaravelEnso\Forms\Services\Form;
use LaravelEnso\People\Models\Person as Model;

class Person
{
    private const TemplatePath = __DIR__ . '/../Templates/person.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Model $person)
    {
        if ($person->hasUser()) {
            $this->form->meta(
                'email',
                'tooltip',
                'Email can only be edited via the user form'
            )->readonly('email');
        }

        return $this->form
            ->value('company', $person->company()?->id)
            ->append('userId', $person->user?->id)
            ->edit($person);
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
