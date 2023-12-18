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
        $sql = " DROP PROCEDURE IF EXISTS insert_log;

        CREATE PROCEDURE insert_log(IN invoiceCode varchar(255), IN cashierName varchar(255), IN target VARCHAR(100), IN description VARCHAR(6), IN oldValue LONGTEXT, IN newValue LONGTEXT)
        BEGIN
            INSERT INTO logs (log_id, log_time, invoice_code, username, log_target, log_description, old_value, new_value)
            VALUES (UUID(), NOW(), invoiceCode, cashierName, target, description, oldValue, newValue);
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
