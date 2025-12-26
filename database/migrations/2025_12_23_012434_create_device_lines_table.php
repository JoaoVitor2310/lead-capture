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
        Schema::create('device_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_type_id')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('iPhone 11, iPhone 12, MacBook Pro');
            $table->string('slug')->comment('slug for the device line');
            $table->text('description')->nullable()->comment('Description for the device line');
            $table->integer('year')->nullable()->comment('Year of release');
            $table->integer('order')->default(0)->comment('Order for the display');
            $table->boolean('active')->default(true)->comment('Active status');
            $table->timestamps();

            $table->unique(['device_type_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_lines');
    }
};
