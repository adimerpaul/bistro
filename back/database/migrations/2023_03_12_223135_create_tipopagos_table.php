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
        Schema::create('tipopagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigoClasificador');
            $table->string('descripcion');
            $table->integer('codigoPuntoVenta');
            $table->integer('codigoSucursal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipopagos');
    }
};