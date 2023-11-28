<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastTransaction extends Model
{
    use HasFactory;
    protected $table = "last_transaction_view";
}
