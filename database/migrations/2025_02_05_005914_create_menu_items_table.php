<?php

use App\Enums\GeneralStatusEnum;
use App\Enums\StockStatusEnum;
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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_category_id');
            $table->string('name')->unique();
            $table->string('photo');
            $table->float('price', 9, 2);
            $table->string('currency_type');
            $table->string('is_available')->default(StockStatusEnum::AVAILIABLE->value);
            $table->string('status')->default(GeneralStatusEnum::ACTIVE->value);
            $table->auditColumns();

            $table->foreign('menu_category_id')
                ->references('id')
                ->on('menu_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
