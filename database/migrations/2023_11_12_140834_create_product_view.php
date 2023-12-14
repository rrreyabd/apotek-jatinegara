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
            (
        		SELECT g_sub.product_expired
        		FROM product_details g_sub
                WHERE g_sub.product_stock > 0
				AND g_sub.product_id = a.product_id
        		ORDER BY g_sub.product_expired
        		LIMIT 1
    		) AS product_expired,
            SUM(g.product_stock) AS product_stock,
            (
        		SELECT g_sub.product_buy_price
        		FROM product_details g_sub
        		WHERE g_sub.product_stock > 0
                AND g_sub.product_id = a.product_id
                ORDER BY g_sub.product_expired
        		LIMIT 1
    		) AS product_buy_price,
			a.product_sell_price
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
        	product_details g ON a.product_id = g.product_id
		GROUP BY
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
            b.product_notice";

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
