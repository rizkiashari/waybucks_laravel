<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_topping', 'price_topping', 'photo_topping'
    ];

    public function transaction_topping()
    {
        return $this->hasOne(TransactionTopping::class);
    }
}
