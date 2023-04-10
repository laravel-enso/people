<?php

namespace LaravelEnso\People\Imports\Validators;

use LaravelEnso\DataImport\Models\Import;
use LaravelEnso\DataImport\Services\Validators\Validator;
use LaravelEnso\Helpers\Services\Obj;
use LaravelEnso\People\Models\Person;

class People extends Validator
{
    public function run(Obj $row, Import $import)
    {
        $name = $row->get('name');
        if (Person::whereName($name)->exists()) {
            $this->addError(__('Name :name exist.', [
                'name' => $name
            ]));
        }

        $email = $row->get('email');
        if (Person::whereEmail($email)->exists()) {
            $this->addError(__('Email :email already exists.', [
                'email' => $email
            ]));
        }

        $nin = $row->get('nin');
        if (Person::whereNin($nin)->exists()) {
            $this->addError(__('Nin :nin already exists.', [
                'nin' => $nin
            ]));
        }


    }
}
