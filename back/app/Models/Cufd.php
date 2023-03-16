<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cufd extends Model
{
    use HasFactory;
    protected $fillable= [
        'codigo',
        'codigoControl',
        'direccion',
        'fechaVigencia',
        'codigoPuntoVenta',
        'codigoSucursal',
    ];
    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
