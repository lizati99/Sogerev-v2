<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'RS',
        'description',
        'phone_number_1',
        'phone_number_2',
        'fix',
        'fax',
        'address',
        'city',
        'email',
        'siteweb',
        'logo'
    ];

    // public function devis(){
    //     return $this->hasMany(Devi::class);
    // }

    // public function purchaseOrders(){
    //     return $this->hasMany(PurchaseOrder::class);
    // }

    // public function salesOrders(){
    //     return $this->hasMany(SaleOrder::class);
    // }

    // public function receptions(){
    //     return $this->hasMany(Reception::class);
    // }

    // public function clients(){
    //     return $this->hasMany(Client::class);
    // }

    // public function suppliers(){
    //     return $this->hasMany(Supplier::class);
    // }
    // public function stocks(){
    //     return $this->hasMany(Stock::class);
    // }

    public function products(){
        return $this->hasMany(Product::class);
    }

    // public function deliveries(){
    //     return $this->hasMany(Delivery::class);
    // }

    // public function invoices(){
    //     return $this->hasMany(Invoice::class);
    // }

    // public function cashRegisters(){
    //     return $this->hasMany(CashRegister::class);
    // }
}
