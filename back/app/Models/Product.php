<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
    'price',
    'imagen',
    'color',
    'cantidad',
    'estado',
    'category_id',"shop_id"
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
