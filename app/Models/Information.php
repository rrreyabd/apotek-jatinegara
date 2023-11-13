<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $primaryKey = 'information_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'information_id',
        'apotic_name',
        'apotic_web_name',
        'SIA_number',
        'SIPA_number',
        'apotic_owner',
        'apotic_address',
        'monday_schedule',
        'tuesday_schedule',
        'wednesday_schedule',
        'thursday_schedule',
        'friday_schedule',
        'saturday_schedule',
        'sunday_schedule',
    ];
}
