<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_number',
        'payment_type',
        'reception_date',
        'realization_date',
        'experation_date',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'createdBy',
        'updatedBy',
        'supplier_id',
        'entreprise_id',
        'cash_register_id',
        'purchase_order_id'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function purchaseOrdersLines(){
        return $this->hasMany(PurchaseOrderLine::class);
    }

    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }
}
