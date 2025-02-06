<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Enums\GeneralStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_type_id' => \App\Models\RoomsType::factory(),
            'room_name' => $this->faker->word(),
            'room_photo' => json_encode([$this->faker->imageUrl()]),
            'beds' => json_encode([$this->faker->numberBetween(1, 4)]),
            'price' => $this->faker->randomFloat(2, 1, 999999999),
            'promotion_price' => $this->faker->randomFloat(2, 1, 999999999),
            'currency_type' => $this->faker->currencyCode(),
            'room_qr' => $this->faker->uuid(),
            'status' => GeneralStatusEnum::ACTIVE->value,
        ];
    }
}
