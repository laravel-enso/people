<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\People\app\Http\Requests\ValidatePersonUpdate;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonUpdate $request, Person $person)
    {
        tap($person)->update($request->validated())
            ->syncCompanies(
                $request->get('companies'), $request->get('company')
            );

        return ['message' => __('The person was successfully updated')];
    }
}
