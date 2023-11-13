<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'category',
    ];

    public function product_description(){
        return $this->hasMany(ProductDescription::class, 'category_id');
    }
}
