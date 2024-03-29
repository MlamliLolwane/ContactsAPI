<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $increment = 1;
        
        return [
            'cell_phone' => $this->faker->phoneNumber(),
            'whatsapp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'preffered_contact_method' => 'both',
            'learner_id' => $increment++
        ];
    }
}
