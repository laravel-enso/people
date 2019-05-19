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
        $person->fill($request->validated());

        $this->authorize('handle', $person);

        $person->save();
        $person->syncCompanies($request->get('companies'));
        $mainCompany = $person->company();

        if ($request->get('company') !== optional($mainCompany)->id) {
            if ($mainCompany) {
                $person->removeMainCompany($mainCompany->id);
            }

            $person->setMainCompany($request->get('company'));
        }

        return ['message' => __('The person was successfully updated')];
    }
}
