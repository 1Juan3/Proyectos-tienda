<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranferencias extends Model
{
    use HasFactory;
    protected $table = "historialpasar";
    protected $guarded = [];

    public function tiendas(){
        return $this->belongsTo(Tiendas::class, 'tienda_id');
    }
}
