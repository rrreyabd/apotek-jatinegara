<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_id';
    public $incrementing = false;
    public $timestamps = false;
    

    protected $guarded = [
        'id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
