<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisLine extends Model
{

    use HasFactory;
    protected $fillable = [
        'designation',
        'unit_price',
        'quantity',
        'TVA_rate',
        'price_HT',
        'devi_id',
        'product_id'
    ];

    public function quote()
    {
        return $this->belongsTo(Devi::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
