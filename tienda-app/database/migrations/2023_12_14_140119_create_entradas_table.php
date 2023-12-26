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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('codigo')->nullable();
            $table->integer('precio_compra')->nullable();
            $table->integer('precio_venta')->nullable();
            $table->decimal('cantidad')->nullable();
            $table->integer('id_provedor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
