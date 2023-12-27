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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('venta_id');
            $table->integer('cliente_id');
            $table->integer('producto_id');
            $table->integer('descuento')->nullable();
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->integer('total');
            $table->integer('tienda_id');
            $table->string('tipo_venta')->default(true); // Campo booleano 'credito' con valor por defecto true
            $table->datetime('fecha_limite');
            $table->enum('estado', ['Pendiente', 'Pagado', 'Proceso'])->default('Pagado'); // Campo enum 'estado' con valores predefinidos
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
