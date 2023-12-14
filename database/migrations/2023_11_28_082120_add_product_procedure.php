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
        DROP PROCEDURE IF EXISTS add_product_procedure;

        CREATE PROCEDURE add_product_procedure(
            IN product_id CHAR(36),
            IN description_id CHAR(36),
            IN product_name VARCHAR(255),
            IN product_status ENUM('aktif', 'tidak aktif', 'exp'),
            IN gambar_obat_file VARCHAR(255),
            IN desc_id CHAR(36),
            IN kategori CHAR(36),
            IN golongan CHAR(36),
            IN satuan_obat CHAR(36),
            IN NIE VARCHAR(15),
            IN tipe VARCHAR(255),
            IN pemasok CHAR(36),
            IN produksi VARCHAR(255),
            IN deskripsi LONGTEXT,
            IN efek_samping LONGTEXT,
            IN dosis LONGTEXT,
            IN indikasi LONGTEXT,
            IN peringatan LONGTEXT,
            IN harga_beli INT,
            IN expired_date TIMESTAMP,
            IN harga_jual INT,
            IN stock INT,
            IN detail_id CHAR(36)
        )
        BEGIN
        
            DECLARE errno INT;
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                ROLLBACK;
            END;
            
            START TRANSACTION;
            
            INSERT INTO product_descriptions (description_id, category_id, group_id, unit_id, product_DPN, product_type, supplier_id, product_manufacture, product_description, product_sideEffect, product_dosage, product_indication, product_notice, product_photo)
            VALUES (desc_id, kategori, golongan, satuan_obat, NIE, tipe, pemasok, produksi, deskripsi, efek_samping, dosis, indikasi, peringatan, gambar_obat_file);
        
            INSERT INTO products (product_id, product_status, product_name, product_sell_price, description_id)
            VALUES (product_id, product_status, product_name, harga_jual, desc_id);
        
            INSERT INTO product_details (product_id, detail_id, product_buy_price, product_expired, product_stock)
            VALUES (product_id, detail_id, harga_beli, expired_date, stock);
            
            COMMIT;
            
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