<?php

namespace LaravelEnso\People\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\People\app\Forms\Builders\PersonForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\People\app\Http\Requests\ValidatePersonRequest;

class PersonController extends Controller
{
    use AuthorizesRequests;

    public function create(PersonForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store()
    {
        $request = app()->make($this->requestValidator());

        $person = Person::create($request->validated());

        return [
            'message' => __('The person was successfully created'),
            'redirect' => 'administration.people.edit',
            'id' => $person->id,
        ];
    }

    public function edit(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }

    public function update(Person $person)
    {
        $request = app()->make($this->requestValidator());

        $person->fill($request->validated());

        $this->authorize('update', $person);

        $person->save();

        return ['message' => __('The person was successfully updated')];
    }

    public function destroy(Person $person)
    {
        $this->authorize('handle', $person);

        $person->delete();

        return [
            'message' => __('The person was successfully deleted'),
            'redirect' => 'administration.people.index',
        ];
    }

    private function requestValidator()
    {
        return class_exists(config('enso.people.requestValidator'))
            ? config('enso.people.requestValidator')
            : ValidatePersonRequest::class;
    }
}
