<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Enums\ItemStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 1, 999999999);
        $qty = $this->faker->numberBetween(1, 100);
        return [
            'order_id' => Order::factory(),
            'item_name' => $this->faker->word(),
            'qty' => $qty,
            'price' => $price,
            'amount' => $qty * $price,
            'status' => ItemStatusEnum::CONFIRM->value,
        ];
    }
}
