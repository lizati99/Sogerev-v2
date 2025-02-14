<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'code_postal',
        'siteweb'
    ];

    // public function devis()
    // {
    //     return $this->hasMany(Devi::class);
    // }

    // public function salesOrders(){
    //     return $this->hasMany(SaleOrder::class);
    // }
}
