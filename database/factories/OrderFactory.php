<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Room;
use App\Enums\PaymentMethodEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'mac_address' => $this->faker->macAddress(),
            'order_session' => $this->faker->uuid(),
            'order_confirm_at' => $this->faker->optional()->dateTime(),
            'order_cancel_at' => $this->faker->optional()->dateTime(),
            'order_complete_at' => $this->faker->optional()->dateTime(),
            'total_amount' => $this->faker->randomFloat(2, 1, 999999999),
            'pay_amount' => $this->faker->randomFloat(2, 1, 999999999),
            'refund_amount' => $this->faker->randomFloat(2, 1, 999999999),
            'remark' => $this->faker->sentence(),
            'currency_type' => $this->faker->currencyCode(),
            'waiting_time' => $this->faker->time(),
            'payment_method' => PaymentMethodEnum::ONLINE_PAYMENT->value,
            'status' => OrderStatusEnum::ORDERING->value,
        ];
    }
}
