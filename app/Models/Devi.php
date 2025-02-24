<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devi extends Model
{
    use HasFactory;

    protected $fillable = [
        'devis_number',
        'title',
        'subject',
        'devis_date',
        'expiration_date',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'discount',
        'note',
        'status',
        'created_by',
        'updated_by',
        'entreprise_id',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    public function devisLines()
    {
        return $this->hasMany(DevisLine::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class);
    }

}
