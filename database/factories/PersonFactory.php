<?php

namespace LaravelEnso\People\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelEnso\People\Models\Person;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'appellative' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'birthday' => Carbon::now()->subYears(rand(15, 40)),
            'bank' => $this->faker->word,
            'bank_account' => $this->faker->bankAccountNumber,
        ];
    }
}
