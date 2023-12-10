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
            $table->decimal('precio_compra', 8, 2)->nullable();
            $table->decimal('precio_venta', 8, 2)->nullable();
            $table->decimal('stock')->nullable();
            $table->integer('category_id')->nullable();
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
