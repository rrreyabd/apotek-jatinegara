<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $primaryKey = 'unit_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'unit_id',
        'unit',
    ];

    public function product_description(){
        return $this->hasMany(ProductDescription::class, 'unit_id');
    }
}
