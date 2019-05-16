<?php

Route::namespace('LaravelEnso\People\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration/people')
    ->as('administration.people.')
    ->group(function () {
        Route::get('create', 'Create')->name('create');
        Route::post('', 'Store')->name('store');
        Route::get('{person}/edit', 'Edit')->name('edit');
        Route::patch('{person}', 'Update')->name('update');
        Route::delete('{person}', 'Destroy')->name('destroy');

        Route::get('initTable', 'Table@init')->name('initTable');
        Route::get('tableData', 'Table@data')->name('tableData');
        Route::get('exportExcel', 'Table@excel')->name('exportExcel');

        Route::get('options', 'Options')->name('options');
    });
