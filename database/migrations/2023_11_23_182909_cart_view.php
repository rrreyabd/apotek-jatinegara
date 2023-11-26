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
        CREATE OR REPLACE VIEW cart_view AS
        SELECT a.cart_id, a.user_id, b.product_id, b.product_photo, b.product_name, b.category, b.product_type, b.product_stock, b.product_expired, b.product_sell_price, a.quantity, Total_Harga(a.quantity, b.product_sell_price) AS total_harga
        FROM carts a
        JOIN product_view b ON a.product_id = b.product_id;
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
