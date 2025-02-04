<?php

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->string('mac_address');
            $table->string('order_session')->unique();
            $table->datetime('order_confirm_at')->nullable()->default(null);
            $table->datetime('order_cancel_at')->nullable()->default(null);
            $table->datetime('order_complete_at')->nullable()->default(null);
            $table->float('total_amount', 9, 2);
            $table->float('pay_amount', 9, 2)->default(0);
            $table->float('refund_amount', 9, 2)->default(0);
            $table->string('remark')->nullable()->default(null);
            $table->string('currency_type');
            $table->time('waiting_time');
            $table->string('payment_method')->default(PaymentMethodEnum::ONLINE_PAYMENT->value);
            $table->string('status')->default(OrderStatusEnum::ORDERING->value);
            $table->auditColumns();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
