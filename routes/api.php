<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\People\Http\Controllers\Create;
use LaravelEnso\People\Http\Controllers\Destroy;
use LaravelEnso\People\Http\Controllers\Edit;
use LaravelEnso\People\Http\Controllers\ExportExcel;
use LaravelEnso\People\Http\Controllers\InitTable;
use LaravelEnso\People\Http\Controllers\Options;
use LaravelEnso\People\Http\Controllers\Store;
use LaravelEnso\People\Http\Controllers\TableData;
use LaravelEnso\People\Http\Controllers\Update;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/administration/people')
    ->as('administration.people.')
    ->group(function () {
        Route::get('create', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{person}/edit', Edit::class)->name('edit');
        Route::patch('{person}', Update::class)->name('update');
        Route::delete('{person}', Destroy::class)->name('destroy');

        Route::get('initTable', InitTable::class)->name('initTable');
        Route::get('tableData', TableData::class)->name('tableData');
        Route::get('exportExcel', ExportExcel::class)->name('exportExcel');

        Route::get('options', Options::class)->name('options');
    });
