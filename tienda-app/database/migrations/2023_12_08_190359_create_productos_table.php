<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('nombre')->nullable();
            $table->string('codigo')->nullable();
            $table->integer('precio_compra')->nullable();
            $table->integer('precio_venta')->nullable();
            $table->decimal('stock')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('tienda_id')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
