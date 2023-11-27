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
        DROP FUNCTION IF EXISTS Total_Pemasukan;

        CREATE FUNCTION Total_Pemasukan(`tanggal_awal` TIMESTAMP, `tanggal_akhir` TIMESTAMP)
        RETURNS INT       
        DETERMINISTIC
        BEGIN
            DECLARE Total_Pemasukan INT;
        
            SELECT SUM(total_harga(b.quantity, b.product_sell_price)) AS total_pemasukan INTO Total_Pemasukan
            FROM selling_invoices a
            JOIN selling_invoice_details b ON a.selling_invoice_id = b.selling_invoice_id
            WHERE a.order_date BETWEEN tanggal_awal AND tanggal_akhir
            AND (a.order_status = 'Berhasil' OR a.order_status = 'Offline' OR a.order_status = 'Gagal');

            RETURN (Total_Pemasukan);
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
