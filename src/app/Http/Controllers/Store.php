<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Http\Requests\ValidatePersonRequest;
use LaravelEnso\People\app\Models\Person;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonRequest $request, Person $person)
    {
        $person->fill($request->validated())->save();

        $person->syncCompanies(
            $request->get('companies'), $request->get('company')
        );

        return [
            'message' => __('The person was successfully created'),
            'redirect' => 'administration.people.edit',
            'param' => ['person' => $person->id],
        ];
    }
}
