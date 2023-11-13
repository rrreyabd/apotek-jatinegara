<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
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

    public function description()
    {
        return $this->belongsTo(ProductDescription::class, 'description_id');
    }

    public function detail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
