<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'product_id',
        'detail_id',
        'product_name',
        'product_expired',
        'product_stock',
        'product_buy_price',
        'product_sell_price',
        'product_status',
    ];

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class, 'detail_id');
    }
}
