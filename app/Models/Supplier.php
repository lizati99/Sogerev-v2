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
        'address',
        'city',
        'region',
        'postal_code',
        'country',
        'email',
        'phone_number',
        'contact',
        'website',
    ];

    // public function receptions(){
    //     return $this->hasMany(Reception::class);
    // }
    // public function purchaseOrders(){
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}
