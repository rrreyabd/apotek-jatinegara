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
        DROP TRIGGER IF EXISTS cannot_update_selling_invoices;

        CREATE TRIGGER cannot_update_selling_invoices 
        BEFORE UPDATE ON selling_invoices 
        FOR EACH ROW 
        BEGIN
            IF (OLD.invoice_code <> NEW.invoice_code OR OLD.customer_id <> NEW.customer_id OR OLD.recipient_name <> NEW.recipient_name OR OLD.recipient_phone <> NEW.recipient_phone OR OLD.recipient_file <> NEW.recipient_file OR OLD.recipient_request <> NEW.recipient_request OR OLD.recipient_bank <> NEW.recipient_bank OR OLD.recipient_payment <> NEW.recipient_payment OR OLD.order_date <> NEW.order_date) THEN
                SIGNAL SQLSTATE '45000' SET
                MESSAGE_TEXT = 'Tidak Dapat Mengupdate Data Berikut Pada Invoice';
            END IF;
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
