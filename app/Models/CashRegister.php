<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'actual_balance',
        'status',
        'operation_type',
        'amount',
    ];

    public function updateSolde($amount, $operationType)
    {
        if ($operationType) { // If the operation is true (money entry)
            $this->balance += $amount;
        } else { // If the operation is false (money entry)
            $this->balance -= $amount;
        }

        if ($this->balance > 0) {
            $this->status = "green";
        } elseif ($this->balance == 0) {
            $this->status = "orange";
        } else {
            $this->status = "red";
        }

        $this->save();
    }
}
