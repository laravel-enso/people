<?php

namespace LaravelEnso\People\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;
use LaravelEnso\People\Enums\Titles;

class Person extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'appellative' => $this->appellative,
            'birthday' => optional($this->birthday)->format(Config::get('config.enso.dateFormat')),
            'title' => Titles::get($this->title),
            'phone' => $this->phone,
        ];
    }
}
