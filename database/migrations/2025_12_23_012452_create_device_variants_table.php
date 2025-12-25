<?php

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
        Schema::create('device_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_model_id')->constrained()->cascadeOnDelete();
            $table->string('storage')->comment('64GB, 128GB, 256GB, 512GB, 1TB');
            $table->string('color')->comment('Black, White, Blue, Gold');
            $table->string('color_hex')->nullable()->comment('Hex color for the UI');
            $table->decimal('trade_in_value', 10, 2)->nullable()->comment('Trade-in value');
            $table->decimal('sale_price', 10, 2)->nullable()->comment('Sale price');
            $table->boolean('available_for_trade')->default(true)->comment('Available for trade');
            $table->boolean('available_for_sale')->default(true)->comment('Available for sale');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->unique(['device_model_id', 'storage', 'color']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_variants');
    }
};
