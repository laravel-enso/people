<?php

namespace LaravelEnso\People\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePersonStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'integer|nullable',
            'name' => 'required|max:50',
            'appellative' => 'string|max:12|nullable',
            'uid' => ['string', 'nullable', $this->uidUnique()],
            'email' => ['email', 'nullable', $this->emailUnique()],
            'phone' => 'max:30|nullable',
            'birthday' => 'date|nullable',
            'position' => 'integer|nullable',
            'obs' => 'string|nullable',
            'companies' => 'array',
            'company' => 'nullable|exists:companies,id',
        ];
    }

    public function withValidator($validator)
    {
        if ($this->filled('company')) {
            $validator->after(function ($validator) {
                if (! collect($this->get('companies'))->contains($this->get('company'))) {
                    $validator->errors()->add(
                        'company',
                        'You cannot set as main company one that is not associated to this person'
                    );
                }
            });
        }
    }

    protected function uidUnique()
    {
        return Rule::unique('people', 'uid');
    }

    protected function emailUnique()
    {
        return Rule::unique('people', 'email');
    }
}
