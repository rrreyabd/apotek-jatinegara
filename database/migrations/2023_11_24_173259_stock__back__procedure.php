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
        DROP PROCEDURE IF EXISTS stock_back;

        CREATE PROCEDURE stock_back(IN stock INT, IN product CHAR(36))
        BEGIN 
            UPDATE product_details 
            SET product_stock = product_stock + stock
            WHERE product_id COLLATE utf8mb4_unicode_ci = product COLLATE utf8mb4_unicode_ci
            ORDER BY product_expired LIMIT 1;
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
