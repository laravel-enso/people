<?php

namespace LaravelEnso\People\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelEnso\People\Enums\Genders;
use LaravelEnso\People\Enums\Titles;
use LaravelEnso\People\Models\Person;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        $title = Titles::keys()->random();
        $gender = $title === Titles::Mr
            ? Genders::Male
            : Genders::Female;

        return [
            'title' => $title,
            'name' => $this->faker->name(lcfirst(Genders::get($gender))),
            'appellative' => $this->faker->firstName(lcfirst(Genders::get($gender))),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'birthday' => Carbon::now()->subYears(rand(15, 40)),
            'bank' => $this->faker->word,
            'bank_account' => $this->faker->bankAccountNumber,
        ];
    }
}
