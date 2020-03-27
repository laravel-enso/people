<?php

namespace LaravelEnso\People\App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\People\App\Http\Requests\ValidatePersonRequest;
use LaravelEnso\People\App\Models\Person;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonRequest $request, Person $person)
    {
        $this->authorize('update', [$person, $request->get('companies')]);

        tap($person)->update($request->validated())
            ->syncCompanies(
                $request->get('companies'), $request->get('company')
            );

        return ['message' => __('The person was successfully updated')];
    }
}
