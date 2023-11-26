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
        CREATE OR REPLACE VIEW cashier_view AS
        SELECT a.user_id, a.username, a.email, a.password, a.role, b.cashier_phone, b.cashier_gender, b.cashier_address
        FROM users a
        JOIN cashiers b ON a.user_id = b.user_id
        WHERE a.role = 'cashier';
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
