<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDraftLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'quantity',
        'unit_price',
        'TVA_rate',
        'price_HT',
        'order_draft_id',
        'product_id'
    ];

    public function orderDraft()
    {
        return $this->belongsTo(OrderDraft::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
