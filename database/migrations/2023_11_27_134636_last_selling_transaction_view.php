<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        $sql = "
            CREATE OR REPLACE VIEW last_transaction_view AS
            SELECT 
                order_complete AS Tanggal_Transaksi, 
                invoice_code, 
                'Penjualanan' AS Tipe_Transaksi, recipient_bank,
                (SELECT SUM(Total_Harga(quantity, product_sell_price)) 
                FROM selling_invoice_details sid 
                WHERE sid.selling_invoice_id = si.selling_invoice_id
                GROUP BY sid.selling_invoice_id) AS Total_Pengeluaran
            FROM 
                selling_invoices si
            WHERE 
                order_complete IS NOT NULL
                
            UNION

            SELECT order_date AS Tanggal_Transaksi, buying_invoice_id AS invoice_code, 'Pembelian' AS Tipe_Transaksi, 'Tunai' AS recepient_bank,
            (SELECT SUM(Total_Harga(quantity, product_buy_price)) 
                FROM buying_invoice_details bid 
                WHERE bid.buying_invoice_id = bi.buying_invoice_id
                GROUP BY bid.buying_invoice_id) AS Total_Pengeluaran
            FROM 
                buying_invoices bi
            ORDER BY
                Tanggal_Transaksi DESC
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
