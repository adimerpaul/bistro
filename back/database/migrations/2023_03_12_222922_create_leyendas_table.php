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
        Schema::create('leyendas', function (Blueprint $table) {
            $table->id();
            $table->string('codigoActividad');
            $table->string('descripcionLeyenda');
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
        Schema::dropIfExists('leyendas');
    }
};
