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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->integer('mesa')->comment('Numero de la mesa');
            $table->double('total', 8, 2)->default(0)->comment('Total de la venta');
            $table->integer('reimprimir')->default(0)->comment('0: No, 1: Si');
            $table->string('status')->default('PENDIENTE')->comment('[PENDIENTE, REALIZADO, CANCELADO]');
            $table->integer('sale_id')->nullable()->comment('Id de la venta');
            $table->timestamps();
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
