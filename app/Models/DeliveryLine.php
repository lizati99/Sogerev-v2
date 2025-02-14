<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_price',
        'quantity',
        'total_price',
        'delivery_id',
        'product_id',
        'stock_id'
    ];

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }
}
