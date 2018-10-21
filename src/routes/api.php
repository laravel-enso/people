<?php

Route::namespace('LaravelEnso\People\app\Http\Controllers')
    ->middleware(['web', 'auth', 'core'])
    ->prefix('api/administration')
    ->as('administration.')
    ->group(function () {
        Route::prefix('people')->as('people.')
            ->group(function () {
                Route::get('initTable', 'PersonTableController@init')
                    ->name('initTable');
                Route::get('getTableData', 'PersonTableController@data')
                    ->name('getTableData');
                Route::get('exportExcel', 'PersonTableController@excel')
                    ->name('exportExcel');

                Route::get('options', 'PersonSelectController@options')
                    ->name('options');
            });

        Route::resource('people', 'PersonController', ['except' => ['index', 'show']]);
    });
