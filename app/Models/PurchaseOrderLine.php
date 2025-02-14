<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'unit_price',
        'quantity',
        'total_HT'
    ];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
