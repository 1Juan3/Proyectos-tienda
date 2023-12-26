<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Client;
use App\Models\Producto;


class Ventas extends Model
{
    use HasFactory;
    protected $guarded = [];
    // En el modelo Venta
// En el modelo Venta
public function cliente()
{
    return $this->belongsTo(Client::class, 'cliente_id');
}

public function producto()
{
    return $this->belongsTo(Producto::class, 'producto_id');
}
// Relación con la tabla 'abonos'
    public function abonos()
    {
        return $this->hasMany(Abonos::class, 'venta_id');
    }

}
