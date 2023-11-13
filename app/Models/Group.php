<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'group',
    ];

    public function product_description(){
        return $this->hasMany(ProductDescription::class, 'group_id');
    }
}
