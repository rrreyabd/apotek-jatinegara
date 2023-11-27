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
        CREATE OR REPLACE VIEW expired_product_view AS
        SELECT a.product_name, d.supplier, SUM(b.product_stock) AS product_stock
        FROM products a 
        JOIN product_details b ON a.product_id = b.product_id 
        JOIN product_descriptions c ON a.description_id = c.description_id
        JOIN suppliers d ON d.supplier_id = c.supplier_id
        WHERE DATE_ADD(NOW(), INTERVAL 3 MONTH) >= b.product_expired 
        GROUP BY a.product_name, d.supplier;
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
