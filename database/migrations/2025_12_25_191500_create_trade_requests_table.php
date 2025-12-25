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

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Dispositivo que o usuário TEM (para dar na troca)
            $table->foreignId('current_device_variant_id')
                ->nullable()
                ->constrained('device_variants')
                ->nullOnDelete();

            // Dispositivo que o usuário QUER (para comprar/receber)
            $table->foreignId('desired_device_variant_id')
                ->nullable()
                ->constrained('device_variants')
                ->nullOnDelete();

            // Informações adicionais sobre o dispositivo atual
            $table->enum('current_device_condition', ['excelente', 'bom', 'regular', 'ruim'])->nullable();
            $table->text('current_device_notes')->nullable(); // observações, defeitos, etc.

            // Dados de contato (caso não tenha user_id)
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            // Controle do processo
            $table->enum('status', [
                'pending',      // aguardando análise
                'quoted',       // proposta enviada
                'accepted',     // cliente aceitou
                'rejected',     // cliente recusou
                'completed',    // troca finalizada
                'cancelled'     // cancelado
            ])->default('pending');

            $table->decimal('trade_in_offer', 10, 2)->nullable();  // valor oferecido pelo dispositivo atual
            $table->decimal('final_price', 10, 2)->nullable();     // preço final (desejado - troca)
            $table->text('admin_notes')->nullable();               // notas internas do admin

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
