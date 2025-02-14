<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_id',
        'product_id',
        'received_quantity',
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
