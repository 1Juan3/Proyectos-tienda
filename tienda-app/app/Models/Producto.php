<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tiendas;
class Producto extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function entradas() {
        return $this->hasMany(Entradas::class);
    }

    public function tienda()
    {
        return $this->belongsTo(Tiendas::class);
    }
}
