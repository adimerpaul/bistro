<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['fecha','hora','mesa','status','sale_id'];

    public function detailorders(){
        return $this->hasMany(Detailorder::class);
    }
}
