<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoiceDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'selling_detail_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'selling_detail_id',
        'selling_invoice_id',
        'product_name',
        'product_type',
        'product_sell_price',
        'quantity',
    ];

    public function sellingInvoice()
    {
        return $this->belongsTo(SellingInvoice::class, 'selling_invoice_id');
    }
}
