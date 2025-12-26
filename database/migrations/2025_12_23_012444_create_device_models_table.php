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
        Schema::create('device_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_line_id')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('Pro, Pro Max, Mini, Air');
            $table->string('slug');
            $table->text('description')->nullable()->comment('Description for the device model');
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->unique(['device_line_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_models');
    }
};
