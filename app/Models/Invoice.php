<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'invoice_date',
        'expiry_date', // max 60 days
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'payment_status',
        'from_id',
        'to_id',
        'delivery_id'
        // 'counter'
    ];

    public function toClient()
    {
        return $this->belongsTo(Client::class);
    }

    public function fromEntreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
