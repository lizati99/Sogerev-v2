<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_number',
        'sujet',
        'reception_date',
        'realization_date',
        'experation_date',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'discount',
        'status',
        'remarque',
        'createdBy',
        'updatedBy',
        'supplier_id',
        'payment_type_id',
        'entreprise_id',
        'cash_register_id',
    ];

    public function receptionLines () {
        return $this->hasMany(ReceptionLine::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }
}
