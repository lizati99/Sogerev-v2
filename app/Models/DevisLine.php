<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisLine extends Model
{

    use HasFactory;
    protected $fillable = [
        'designation',
        'quantity',
        'width',
        'height',
        'unitMeasure',
        'unitprice_HT',
        'TVA_rate',
        'total_TVA',
        'total_HT',
        'total_TTC',
        'devi_id',
        'product_id'
    ];

    public function devi()
    {
        return $this->belongsTo(Devi::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
