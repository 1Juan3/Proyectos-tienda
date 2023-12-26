<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    
    use HasFactory;
    protected $guarded = [];
    protected $table = "proveedores";
    public function entradas()
    {
        return $this->hasMany(Entradas::class, 'id_provedor', 'id_provedor');
    }
}
