<?php

namespace LaravelEnso\People\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return $this->method() !== 'PATCH'
            || ! $this->route('person')->hasUser()
            || $this->route('person')->email === $this->email;
    }

    public function rules()
    {
        $emailUnique = Rule::unique('people', 'email');
        $uidUnique = Rule::unique('people', 'uid');

        if ($this->method() === 'PATCH') {
            $person = $this->route('person');
            $emailUnique = $emailUnique->ignore($person->id);
            $uidUnique = $uidUnique->ignore($person->id);
        }

        return [
            'title' => 'integer|nullable',
            'name' => 'required|max:50',
            'appellative' => 'string|max:12|nullable',
            'uid' => ['string', 'nullable', $uidUnique],
            'email' => ['email', 'nullable', $emailUnique],
            'phone' => 'max:30|nullable',
            'birthday' => 'date|nullable',
            'gender' => 'integer|nullable',
            'obs' => 'string|nullable',
            'company_id' => 'required_with:position',
        ];
    }
}
