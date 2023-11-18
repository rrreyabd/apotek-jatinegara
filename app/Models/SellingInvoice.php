<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoice extends Model
{
    use HasFactory;
    protected $primaryKey = 'selling_invoice_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'selling_invoice_id',
        'invoice_code',
        'customer_id',
        'cashier_name',
        'customer_name',
        'customer_phone',
        'customer_file',
        'customer_request',
        'customer_bank',
        'customer_payment',
        'order_date',
        'order_complete',
        'refund_file',
        'reject_comment',
        'order_status',
    ];

    public function sellingInvoiceDetail()
    {
        return $this->hasMany(SellingInvoiceDetail::class, 'selling_invoice_id');
    }
}