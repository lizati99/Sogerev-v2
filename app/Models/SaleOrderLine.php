<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SaleOrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_price_HT',
        'quantity',
        'total_HT',
        'product_id',
        'sale_order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function saleOrder()
    {
        return $this->belongsTo(SaleOrder::class);
    }
}
