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
        'sujet',
        'total_HT',
        'total_TVA',
        'total_TTC',
        'TVA_rate',
        'orderDraft_date',
        'status',
        'created_by',
        'updated_by',
        'sale_order_id',
        'client_id'
    ];

}
