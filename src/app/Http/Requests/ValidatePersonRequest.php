<?php

namespace LaravelEnso\People\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return $this->emailUnchagedIfForUser() &&
            (! $this->filled('companies') || $this->allowedCompanies());
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
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'position' => 'integer|nullable',
            'obs' => 'string|nullable',
            'companies' => 'array',
            'company' => 'nullable|exists:companies,id',
        ];
    }

    protected function uidUnique()
    {
        return Rule::unique('people', 'uid')
            ->ignore(optional($this->route('person'))->id);
    }

    protected function emailUnique()
    {
        return Rule::unique('people', 'email')
            ->ignore(optional($this->route('person'))->id);
    }

    private function authorizesCompanies()
    {
        return collect($this->get('companies'))->diff(
            Auth::user()->person->companies()->pluck('id')
        )->isEmpty();
    }

    private function authorizesMainCompany()
    {
        return $this->filled('company')
            ? collect($this->get('companies'))
                ->contains($this->get('company'))
            : true;
    }

    private function emailUnchagedIfForUser()
    {
        return ! optional($this->route('person'))->hasUser()
            || $this->get('email') === $this->route('person')->email;
    }

    private function allowedCompanies()
    {
        return Auth::user()->belongsToAdminGroup()
            || $this->authorizesCompanies()
                && $this->authorizesMainCompany();
    }
}
