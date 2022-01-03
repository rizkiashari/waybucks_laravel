<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid_transaction', 'name_transaction', 'email_transaction', 'phone_transaction', 'postal_code_transaction', 'address_transaction', 'attach_transaction', 'status_transaction', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
