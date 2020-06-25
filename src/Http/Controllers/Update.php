<?php

namespace LaravelEnso\People\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\Http\Requests\ValidatePersonRequest;
use LaravelEnso\People\Models\Person;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonRequest $request, Person $person)
    {
        $this->authorize('update', [$person, $request->get('companies')]);

        tap($person)->update($request->validatedExcept('companies', 'company'))
            ->syncCompanies(
                $request->get('companies'),
                $request->get('company')
            );

        return ['message' => __('The person was successfully updated')];
    }
}
