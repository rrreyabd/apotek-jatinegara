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
        CREATE FUNCTION `Total_Harga`(`jumlah` INT(11), `harga` INT(11)) RETURNS INT       
        DETERMINISTIC
        BEGIN
            RETURN (harga * jumlah);
        END;
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
