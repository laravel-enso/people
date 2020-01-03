<?php

namespace LaravelEnso\People\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ValidatePersonRequest extends FormRequest
{
    private Collection $companies;

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
            'uid' => ['string', 'nullable', $this->unique('uid')],
            'email' => ['email', 'nullable', $this->unique('email')],
            'phone' => 'max:30|nullable',
            'birthday' => 'nullable|date',
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'position' => 'integer|nullable',
            'obs' => 'string|nullable',
            'companies' => 'array',
            'company' => 'nullable|exists:companies,id',
        ];
    }

    protected function unique(string $attribute)
    {
        return Rule::unique('people', $attribute)
            ->ignore(optional($this->route('person'))->id);
    }

    private function authorizesCompanies()
    {
        return $this->companies()->diff(
            Auth::user()->person->companies()->pluck('id')
        )->isEmpty();
    }

    private function authorizesMainCompany()
    {
        return ! $this->filled('company')
            || $this->companies()->contains($this->get('company'));
    }

    private function emailUnchagedIfForUser()
    {
        return ! optional($this->route('person'))->hasUser()
            || $this->get('email') === $this->route('person')->email;
    }

    private function allowedCompanies()
    {
        return Auth::user()->belongsToAdminGroup()
            || $this->authorizesCompanies() && $this->authorizesMainCompany();
    }

    private function companies()
    {
        return $this->companies
            ??= (new Collection($this->get('companies')));
    }
}
