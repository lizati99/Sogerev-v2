<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'available_quantity',
        'unit_price',
        'product_id',
    ];

    // public function receptions()
    // {
    //     return $this->hasMany(Reception::class);
    // }
    // public function deliveries(){
    //     return $this->hasMany(Delivery::class);
    // }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
