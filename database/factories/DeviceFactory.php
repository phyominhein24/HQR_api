<?php

namespace Database\Factories;

use App\Models\Device;
use App\Enums\GeneralStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mac_address' => $this->faker->macAddress(),
            'expired_at' => Carbon::now()->addDays($this->faker->numberBetween(30, 365)),
            'status' => GeneralStatusEnum::ACTIVE->value,
        ];
    }
}
