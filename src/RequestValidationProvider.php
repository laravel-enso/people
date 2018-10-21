<?php

namespace LaravelEnso\People;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\People\app\Contracts\ValidatesPersonRequest;
use LaravelEnso\People\app\Http\Requests\ValidatePersonRequest;

class RequestValidationProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(ValidatesPersonRequest::class,
            config('enso.people.requestValidator')
                ? config('enso.people.requestValidator')
                : ValidatePersonRequest::class
        );
    }

    public function provides()
    {
        return [ValidatesPersonRequest::class];
    }
}
