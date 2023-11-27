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
        DROP PROCEDURE IF EXISTS order_refund;

        CREATE PROCEDURE order_refund(IN `invoiceID` VARCHAR(36), IN `cashierName` VARCHAR(255), IN `comments` LONGTEXT)
        BEGIN
            UPDATE selling_invoices 
            SET order_status = 'Menunggu Pengembalian', cashier_name = cashierName, reject_comment = comments 
            WHERE selling_invoice_id COLLATE utf8mb4_unicode_ci = invoiceID COLLATE utf8mb4_unicode_ci; 
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
