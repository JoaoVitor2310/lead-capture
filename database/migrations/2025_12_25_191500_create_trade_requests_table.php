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
        // create_trade_requests_table.php
        Schema::create('trade_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('current_device_variant_id')
                ->nullable()
                ->constrained('device_variants')
                ->nullOnDelete();

            $table->foreignId('desired_device_variant_id')
                ->nullable()
                ->constrained('device_variants')
                ->nullOnDelete();

            $table->enum('current_device_condition', ['excelente', 'bom', 'regular', 'ruim'])->nullable();
            $table->text('current_device_notes')->nullable();

            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            $table->enum('status', [
                'pending',
                'quoted',
                'accepted',
                'rejected',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->decimal('trade_in_offer', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2)->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_requests');
    }
};
