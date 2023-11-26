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
            CREATE OR REPLACE VIEW bestSellerProduct_view AS
            SELECT a.product_name, b.product_status, COUNT(*) as jumlah_kemunculan
            FROM selling_invoice_details a
            JOIN products b ON a.product_name = b.product_name
            GROUP BY a.product_name, b.product_status
            ORDER BY jumlah_kemunculan DESC
        ";

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sql = "DROP VIEW bestSellerProduct_view";
        DB::statement($sql);
    }
};
