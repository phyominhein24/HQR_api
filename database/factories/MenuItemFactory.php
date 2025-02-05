<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\StockStatusEnum;
use App\Enums\GeneralStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_category_id' => MenuCategory::factory(),
            'name' => $this->faker->unique()->word(),
            'photo' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 999999999),
            'currency_type' => $this->faker->currencyCode(),
            'is_available' => StockStatusEnum::AVAILIABLE->value,
            'status' => GeneralStatusEnum::ACTIVE->value,
            'created_by' => 1, // Adjust as needed
            'updated_by' => 1, // Adjust as needed
        ];
    }
}
