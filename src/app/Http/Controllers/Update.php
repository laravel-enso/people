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

        if ($person->isDirty('company_id')) {
            $this->authorize('change-company', $person);
        }

        $person->save();

        return ['message' => __('The person was successfully updated')];
    }
}
