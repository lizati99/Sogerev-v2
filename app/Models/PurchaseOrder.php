<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_date',
        'total_amount',
        'supplier_id',
        'payment_type_id',
    ];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }

    // public function purchaseOrderLines(){
    //     return $this->hasMany(PurchaseOrderLine::class);
    // }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    // public function reception(){
    //     return $this->hasOne(Reception::class);
    // }
}
