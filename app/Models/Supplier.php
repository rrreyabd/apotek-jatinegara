<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'supplier_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'supplier_id',
        'supplier',
        'supplier_address',
        'supplier_phone',
    ];

    public function product_description(){
        return $this->hasMany(ProductDescription::class, 'supplier_id');
    }
}
