<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Proveedor;
class Entradas extends Model
{
    use HasFactory;
    protected $guarded = [];
    // En el modelo Entradas
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'codigo', 'codigo');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_provedor', 'id');
    }
}
