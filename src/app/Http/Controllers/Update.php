<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\People\app\Http\Requests\ValidatePersonRequest;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonRequest $request, Person $person)
    {
        tap($person)->update($request->validated())
            ->syncCompanies(
                $request->get('companies'), $request->get('company')
            );

        return ['message' => __('The person was successfully updated')];
    }
}
