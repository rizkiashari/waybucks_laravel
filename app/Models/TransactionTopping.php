<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_detail_id', 'topping_id'
    ];

    public function transaction_detail()
    {
        return $this->belongsTo(TransactionDetail::class, 'transaction_detail_id');
    }

    public function topping()
    {
        return $this->belongsTo(Topping::class, 'topping_id');
    }
}
