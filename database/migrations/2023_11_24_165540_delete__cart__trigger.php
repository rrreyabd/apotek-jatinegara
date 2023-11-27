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
        DROP TRIGGER IF EXISTS delete_cart;

        CREATE TRIGGER delete_cart 
        AFTER UPDATE ON products 
        FOR EACH ROW 
        BEGIN 
            IF NEW.product_status = 'tidak aktif' OR NEW.product_status = 'exp' THEN 
                DELETE FROM carts WHERE product_id = NEW.product_id;
            END IF;
        END ;
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
