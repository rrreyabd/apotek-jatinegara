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
        DROP PROCEDURE IF EXISTS order_success;

        CREATE PROCEDURE order_success(IN `invoiceID` CHAR(36), IN `cashierName` VARCHAR(255))
        BEGIN
            UPDATE selling_invoices
            SET order_status = 'Menunggu Pengambilan', cashier_name = cashierName
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
