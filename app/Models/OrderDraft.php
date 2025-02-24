<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDraft extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'title',
        'subject',
        'orderDraft_date',
        'expiration_date',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'discount',
        'note',
        'status',
        'isfinishing',
        'created_by',
        'updated_by',
        'devi_id',
        'entreprise_id',
        'client_id',
        'payment_type_id'
    ];

    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function devi(){
        return $this->belongsTo(Devi::class);
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }

    public function orderDraftLines(){
        return $this->hasMany(OrderDraftLine::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
