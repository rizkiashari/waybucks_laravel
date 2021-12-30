<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_product', 'slug_product', 'price_product', 'photo_product', 'qty_product',
    ];

    public function transaction_detail()
    {
        return $this->hasOne(TransactionDetail::class);
    }
}
