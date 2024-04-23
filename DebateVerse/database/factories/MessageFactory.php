<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'receiver_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'message' => $this->faker->paragraph
        ];
    }
}
