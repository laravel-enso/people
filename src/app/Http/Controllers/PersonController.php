<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\People\app\Forms\Builders\PersonForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\People\app\Contracts\ValidatesPersonRequest;

class PersonController extends Controller
{
    use AuthorizesRequests;

    public function create(PersonForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatesPersonRequest $request)
    {
        $person = new Person($request->all());

        $this->authorize('set-company', $person);

        $person->save();

        return [
            'message' => __('The person was successfully created'),
            'redirect' => 'administration.people.edit',
            'param' => ['person' => $person->id],
        ];
    }

    public function edit(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }

    public function update(ValidatesPersonRequest $request, Person $person)
    {
        $person->fill($request->all());

        if ($person->isDirty('company_id')) {
            $this->authorize('change-company', $person);
        }

        $person->save();

        return ['message' => __('The person was successfully updated')];
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return [
            'message' => __('The person was successfully deleted'),
            'redirect' => 'administration.people.index',
        ];
    }
}
