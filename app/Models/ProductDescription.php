<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;

    protected $primaryKey = 'description_id';
    public $incrementing = false;
    public $timestamps = false;
    

    protected $guarded = [
        'id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'description_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
