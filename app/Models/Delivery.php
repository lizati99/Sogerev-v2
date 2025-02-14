<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_date',
        'address',
        'sale_order_id',
        'order_draft_id',
        'client_id'
    ];

    // public function purchaseOrder(){
    //     return $this->belongsTo(OrderDraft::class);
    // }

    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }

    // public function invoice(){
    //     return $this->belongsTo(Invoice::class);
    // }

    public function deliveryLines(){
        return $this->hasMany(DeliveryLine::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
