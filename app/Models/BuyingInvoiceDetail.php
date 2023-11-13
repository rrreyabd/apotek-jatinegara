<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingInvoiceDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'buying_detail_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'buying_detail_id',
        'buying_invoice_id',
        'product_name',
        'product_buy_price',
        'exp_date',
        'quantity',
    ];

    public function buyingInvoice()
    {
        return $this->belongsTo(BuyingInvoice::class, 'buying_invoice_id');
    }
}
