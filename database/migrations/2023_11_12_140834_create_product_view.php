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
        $sql = "CREATE OR REPLACE VIEW product_view AS
        SELECT DISTINCT
            a.product_id,
            a.product_name,
            a.product_status,
            c.category,
            d.`group`,
            e.unit,
            f.supplier,
            b.product_type,
            b.product_photo,
            b.product_manufacture,
            b.product_DPN,
            b.product_sideEffect,
            b.product_description,
            b.product_dosage,
            b.product_indication,
            b.product_notice,
            g.product_expired,
            g.product_stock,
            g.product_buy_price,
            g.product_sell_price
        FROM
            products a
        JOIN
            product_descriptions b ON a.description_id = b.description_id
        JOIN
            categories c ON b.category_id = c.category_id
        JOIN
            `groups` d ON b.group_id = d.group_id
        JOIN
            units e ON b.unit_id = e.unit_id
        JOIN
            suppliers f ON b.supplier_id = f.supplier_id
        JOIN
            (
                SELECT
                    product_id,
                    product_expired,
                    product_stock,
                    product_buy_price,
                    product_sell_price,
                    ROW_NUMBER() OVER (PARTITION BY product_id ORDER BY product_expired ASC) AS RowNum
                FROM
                    product_details
            ) AS g ON a.product_id = g.product_id;";

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sql = "DROP VIEW product_view";
        DB::statement($sql);
    }
};
