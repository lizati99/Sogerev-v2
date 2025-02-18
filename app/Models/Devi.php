<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devi extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'title',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'devi_date',
        'created_by',
        'updated_by',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
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
