<?php

Route::namespace('LaravelEnso\People\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration/people')
    ->as('administration.people.')
    ->group(function () {
        require 'app/people.php';
    });
