<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\People\app\Http\Requests\ValidatePersonStore;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonStore $request, Person $person)
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
