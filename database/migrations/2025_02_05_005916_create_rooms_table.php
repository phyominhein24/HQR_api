<?php

use App\Enums\GeneralStatusEnum;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_type_id');
            $table->string('room_name')->nullable()->default(null);
            $table->json('room_photo')->nullable()->default(null);
            $table->json('beds');
            $table->float('price', 9, 2);
            $table->float('promotion_price', 9, 2)->default(0);
            $table->string('currency_type');
            $table->string('room_qr');
            $table->string('status')->default(GeneralStatusEnum::ACTIVE->value);
            $table->auditColumns();

            $table->foreign('room_type_id')
                ->references('id')
                ->on('rooms_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
