<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingInvoice extends Model
{
    use HasFactory;
    protected $primaryKey = 'buying_invoice_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'buying_invoice_id',
        'order_date',
        'supplier_name',
    ];

    public function buyingInvoiceDetail()
    {
        return $this->hasMany(BuyingInvoiceDetail::class, 'buying_invoice_id');
    }
}
