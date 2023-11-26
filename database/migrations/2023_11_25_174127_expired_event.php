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
        $sql = " DROP EVENT IF EXISTS check_expired;

        CREATE EVENT check_expired 
        ON SCHEDULE EVERY 1 DAY 
        DO 
            BEGIN 
                CREATE TEMPORARY TABLE IF NOT EXISTS temp_expired_products (product_id_expired char(36)); 
                
                INSERT INTO temp_expired_products (product_id_expired) SELECT product_id FROM product_details WHERE product_expired = CURDATE(); 
                
                UPDATE products SET product_status = 'exp' WHERE product_id IN (SELECT product_id_expired FROM temp_expired_products); 
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
