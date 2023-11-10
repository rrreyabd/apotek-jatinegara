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
        Schema::create('buying_invoices', function (Blueprint $table) {
            $table->uuid('buying_invoice_id')->primary();
            $table->timestamp('order_date');
            $table->string('supplier_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buying_invoices');
    }
};
