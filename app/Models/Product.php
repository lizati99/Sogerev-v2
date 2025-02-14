<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ref',
        'description',
        'unit_price',
        'quantity',
        'is_available',
        // 'stock_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function salesOrdersLines(){
    //     return $this->hasMany(SaleOrderLine::class);
    // }

    // public function purchaseOrdersLines(){
    //     return $this->hasMany(PurchaseOrderLine::class);
    // }

    // public function receptionLines(){
    //     return $this->hasMany(ReceptionLine::class);
    // }

    // public function devisLines(){
    //     return $this->hasMany(DevisLine::class);
    // }

    // public function stock(){
    //     return $this->belongsTo(Stock::class);
    // }
}
