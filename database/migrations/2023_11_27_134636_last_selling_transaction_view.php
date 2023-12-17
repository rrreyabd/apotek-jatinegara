<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        $sql = "
            CREATE OR REPLACE VIEW last_transaction_view AS
            SELECT 
                order_complete AS tanggal_transaksi, 
                invoice_code, 
                'Penjualanan' AS tipe_transaksi, recipient_bank AS metode_pembayaran,
                (SELECT SUM(Total_Harga(quantity, product_sell_price)) 
                FROM selling_invoice_details sid 
                WHERE sid.selling_invoice_id = si.selling_invoice_id
                GROUP BY sid.selling_invoice_id) AS total_pengeluaran
            FROM 
                selling_invoices si
            WHERE 
                order_complete IS NOT NULL
                
            UNION

            SELECT order_date AS tanggal_transaksi, buying_invoice_id AS invoice_code, 'Pembelian' AS tipe_transaksi, 'Tunai' AS metode_pembayaran,
            (SELECT SUM(Total_Harga(quantity, product_buy_price)) 
                FROM buying_invoice_details bid 
                WHERE bid.buying_invoice_id = bi.buying_invoice_id
                GROUP BY bid.buying_invoice_id) AS total_pengeluaran
            FROM 
                buying_invoices bi
            ORDER BY
                tanggal_Transaksi DESC
        ";

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};