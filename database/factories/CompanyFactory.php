<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = \App\Models\Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'logo' => 'storage/app/public/logos/q5ZkPEtzROVerNO1E0p5xQoPsMN35oW7gweUtAfK.png',
            'description' => $this->faker->sentence(),
        ];
    }
}
