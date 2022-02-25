<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\Http\Requests\ValidatePerson;
use LaravelEnso\People\Models\Person;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePerson $request, Person $person)
    {
        $this->authorize('store', [$person, $request->get('companies')]);

        $person->fill($request->validatedExcept('companies', 'company'))->save();

        $person->syncCompanies(
            $request->get('companies'),
            $request->get('company')
        );

        return [
            'message' => __('The person was successfully created'),
            'redirect' => 'administration.people.edit',
            'param' => ['person' => $person->id],
        ];
    }
}
