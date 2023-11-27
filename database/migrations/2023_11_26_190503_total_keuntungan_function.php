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
        DROP FUNCTION IF EXISTS Total_Keuntungan;

        CREATE FUNCTION Total_Keuntungan(`tanggal_awal` TIMESTAMP, `tanggal_akhir` TIMESTAMP)
        RETURNS INT       
        DETERMINISTIC
        BEGIN
            DECLARE total_pemasukan INT;
            DECLARE total_pengeluaran INT;
            
            SET total_pemasukan = COALESCE(total_pemasukan(tanggal_awal, tanggal_akhir), 0);
            SET total_pengeluaran = COALESCE(total_pengeluaran(tanggal_awal, tanggal_akhir), 0);
            
            RETURN (total_pemasukan - total_pengeluaran);
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
