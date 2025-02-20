<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'rs',
        'address',
        'city',
        'region',
        'postal_code',
        // 'country',
        'phone_number',
        'rib',
        'isCompany',
    ];

    // public function receptions(){
    //     return $this->hasMany(Reception::class);
    // }
    // public function purchaseOrders(){
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}
