<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'description'];

    // public function purchaseOrders(){
    //     return $this->hasMany(PurchaseOrder::class);
    // }
    // public function salesOrders(){
    //     return $this->hasMany(SaleOrder::class);
    // }
}
