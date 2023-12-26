<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ventas;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ventas()
{
    return $this->hasMany(Ventas::class, 'cliente_id');
}
}
