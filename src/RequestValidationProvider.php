<?php

namespace LaravelEnso\People;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\People\app\Contracts\ValidatesPersonRequest;
use LaravelEnso\People\app\Http\Requests\ValidatePersonRequest;

class RequestValidationProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            ValidatesPersonRequest::class, ValidatePersonRequest::class
        );
    }
}
