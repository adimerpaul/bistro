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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->string('producto');
            //$table->integer('order_id')->comment('Id de la orden');
            $table->unsignedBigInteger("order_id")->nullable();
            $table->foreign("order_id")->references("id")->on("orders");
            $table->integer('product_id')->comment('Id del producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};