<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'log_time',
        'invoice_code',
        'username',
        'log_target',
        'log_description',
        'old_value',
        'new_value',
    ];
}
