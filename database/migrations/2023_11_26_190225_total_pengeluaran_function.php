<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
        DROP FUNCTION IF EXISTS Total_Pengeluaran;

        CREATE FUNCTION Total_Pengeluaran(`tanggal_awal` TIMESTAMP, `tanggal_akhir` TIMESTAMP)
        RETURNS INT       
        DETERMINISTIC
        BEGIN
            DECLARE Total_Pengeluaran INT;
        
            SELECT SUM(total_harga(b.quantity, b.product_buy_price)) AS total_pengeluaran INTO Total_Pengeluaran
            FROM buying_invoices a
            JOIN buying_invoice_details b ON a.buying_invoice_id = b.buying_invoice_id
            WHERE a.order_date BETWEEN tanggal_awal AND tanggal_akhir;

            RETURN (Total_Pengeluaran);
        END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
