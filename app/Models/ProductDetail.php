<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_id';
    public $timestamps = false;
    

    protected $guarded = [
        'id',
    ];

    public function group(){
        return $this->belongsTo(Group::class, 'group_id');
    }
}
