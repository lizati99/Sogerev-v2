<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
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

    // public function devis()
    // {
    //     return $this->hasMany(Devi::class);
    // }

    // public function salesOrders(){
    //     return $this->hasMany(SaleOrder::class);
    // }
}
