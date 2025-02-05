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
        Schema::create('rooms_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_type')->unique();
            $table->string('description')->nullable()->default(null);
            $table->float('price_rate_min', 9, 2)->default(0);
            $table->float('price_rate_max', 9, 2)->default(0);
            $table->string('status')->default(GeneralStatusEnum::ACTIVE->value);
            $table->auditColumns();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_types');
    }
};
