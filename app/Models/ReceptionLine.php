<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'quantity',
        'width',
        'height',
        'unitMeasure',
        'productStatus',
        'unitPriceHT',
        'TVA_rate',
        'totalTVA',
        'totalHT',
        'totalTTC',
        'reception_id',
        'product_id',
        'stock_id'
    ];

    public function reception(){
        return $this->belongsTo(Reception::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

}
