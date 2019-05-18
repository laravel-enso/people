<?php

namespace LaravelEnso\People\app\Http\Requests;

class ValidatePersonUpdate extends ValidatePersonStore
{
    public function authorize()
    {
        return ! $this->route('person')->hasUser()
            || $this->route('person')->email === $this->get('email');
    }

    protected function uidUnique()
    {
        return parent::uidUnique()->ignore($this->route('person')->id);
    }

    protected function emailUnique()
    {
        return parent::emailUnique()->ignore($this->route('person')->id);
    }
}
