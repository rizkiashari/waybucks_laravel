<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'transaction_id', 'qty_transaction_detail'
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function transaction_topping()
    {
        return $this->hasOne(TransactionTopping::class);
    }
}
