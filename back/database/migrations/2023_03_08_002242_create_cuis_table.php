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
        Schema::create('cuis', function (Blueprint $table) {
            $table->id();
            $table->string("codigo")->nullable();
            $table->dateTime("fechaVigencia")->nullable();
            $table->dateTime("fechaCreacion")->nullable();
            $table->integer("codigoPuntoVenta")->nullable()->default(0);
            $table->integer("codigoSucursal")->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuis');
    }
};
