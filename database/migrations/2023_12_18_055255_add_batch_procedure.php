<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
        DROP PROCEDURE IF EXISTS add_batch_procedure;

        CREATE PROCEDURE add_batch_procedure(IN pemasok_param CHAR(36), IN product_id_param CHAR(36), IN detail_id_param CHAR(36), IN harga_beli_param INT, IN expired_date_param TIMESTAMP, IN stock_param INT)
        BEGIN
            DECLARE existing_invoice_id CHAR(36);

            DECLARE is_transaction_successful BOOLEAN DEFAULT TRUE;

            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                SET is_transaction_successful = FALSE;
                ROLLBACK;
            END;

            START TRANSACTION;

            SELECT bi.buying_invoice_id INTO existing_invoice_id
            FROM buying_invoices bi
            JOIN suppliers s ON bi.supplier_name COLLATE utf8mb4_unicode_ci = s.supplier COLLATE utf8mb4_unicode_ci
            WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok_param COLLATE utf8mb4_unicode_ci
                AND DATE_FORMAT(bi.order_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
            LIMIT 1;

            IF existing_invoice_id IS NULL THEN
                INSERT INTO buying_invoices (buying_invoice_id, supplier_name, order_date)
                VALUES (UUID(), (SELECT s.supplier COLLATE utf8mb4_unicode_ci FROM suppliers s WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok_param COLLATE utf8mb4_unicode_ci), NOW());

                SELECT buying_invoice_id INTO existing_invoice_id
                FROM buying_invoices
                WHERE supplier_name COLLATE utf8mb4_unicode_ci = (SELECT s.supplier COLLATE utf8mb4_unicode_ci FROM suppliers s WHERE s.supplier_id COLLATE utf8mb4_unicode_ci = pemasok_param COLLATE utf8mb4_unicode_ci)
                AND DATE_FORMAT(order_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
                ORDER BY order_date DESC
                LIMIT 1;
            END IF;

            INSERT INTO product_details (product_id, detail_id, product_buy_price, product_expired, product_stock)
            VALUES (product_id_param, detail_id_param, harga_beli_param, expired_date_param, stock_param);

            INSERT INTO buying_invoice_details (buying_detail_id, buying_invoice_id, product_name, product_buy_price, exp_date, quantity)
            VALUES (UUID(), existing_invoice_id, (SELECT product_name FROM products WHERE product_id = product_id_param COLLATE utf8mb4_unicode_ci), harga_beli_param, expired_date_param, stock_param);

            IF is_transaction_successful THEN
                COMMIT;
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
