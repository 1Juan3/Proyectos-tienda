<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiendas extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    // Relación uno a muchos: una tienda tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
