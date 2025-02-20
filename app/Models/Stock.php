<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'current_stock',
        // 'stock_min',
        'stock_in',
        'stock_out',
        'stock_stolen',
        'stock_damaged',
        'stock_returned',
        'product_id',
    ];

    public function receptions()
    {
        return $this->hasMany(Reception::class);
    }
    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
