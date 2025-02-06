<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomsType;
use App\Enums\GeneralStatusEnum;

class RoomsTypeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'room_type' => $this->faker->unique()->word(),
            'price_rate_min' => $this->faker->randomFloat(2, 1, 999999999),
            'price_rate_max' => $this->faker->randomFloat(2, 1, 999999999),
            'status' => GeneralStatusEnum::ACTIVE->value,
        ];
    }
}
