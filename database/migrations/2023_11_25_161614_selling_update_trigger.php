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
        $sql = " DROP TRIGGER IF EXISTS selling_update_trigger;

        CREATE TRIGGER selling_update_trigger 
        AFTER UPDATE ON selling_invoices 
        FOR EACH ROW 
        BEGIN 
            CALL insert_log(NEW.invoice_code ,NEW.cashier_name ,'Status Penjualan', 'update', OLD.order_status, NEW.order_status);
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
