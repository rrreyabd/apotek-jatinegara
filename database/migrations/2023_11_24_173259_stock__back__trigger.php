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
        CREATE TRIGGER stock_back 
        AFTER UPDATE ON selling_invoices 
        FOR EACH ROW 
        BEGIN 
            IF NEW.order_status = 'Menunggu Pengembalian' OR NEW.order_status = 'Gagal' THEN
                UPDATE product_details 
                SET product_stock = product_stock + (SELECT quantity FROM selling_invoice_details WHERE selling_invoice_id = NEW.selling_invoice_id)
                WHERE product_id =
                (SELECT product_id FROM products WHERE product_name = (SELECT product_name FROM selling_invoice_details WHERE selling_invoice_id = NEW.selling_invoice_id)) 
                ORDER BY product_expired LIMIT 1;
            END IF;
        END;
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
