<?php

namespace LaravelEnso\People\app\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $emailUnique = Rule::unique('people', 'email');
        $uidUnique = Rule::unique('people', 'uid');

        if ($this->method() === 'PATCH') {
            $emailUnique = $emailUnique->ignore($this->route('person')->id);
            $uidUnique = $uidUnique->ignore($this->route('person')->id);
        }

        $rules = [
            'title' => 'integer|nullable',
            'name' => 'required|max:50',
            'appellative' => 'string|max:12|nullable',
            'uid' => ['string', 'nullable', $uidUnique],
            'email' => ['email', 'nullable', $emailUnique],
            'phone' => 'max:30|nullable',
            'birthday' => 'date|nullable',
            'gender' => 'integer|nullable',
            'obs' => 'string|nullable',
        ];

        $customValidations = config('enso.people.validations');

        if (is_array($customValidations) && isset($customValidations['uid'])) {
            $rules['uid'][] = $customValidations['uid'];
            Arr::forget($customValidations, 'uid');
        }

        return $rules + $customValidations;
    }
}
