<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonos extends Model
{
    use HasFactory;
    protected $fillable = ['venta_id', 'monto'];

    // Relación con la tabla 'ventas'
    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'venta_id', 'venta_id');
    }
}
