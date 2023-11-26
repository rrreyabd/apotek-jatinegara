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
        Schema::create('selling_invoice_details', function (Blueprint $table) {
            $table->uuid('selling_detail_id')->primary();
            $table->uuid('selling_invoice_id');
            $table->foreign('selling_invoice_id')
                ->references('selling_invoice_id')
                ->on('selling_invoices')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('product_name');
            $table->enum('product_type', ['umum', 'resep dokter']);
            $table->integer('product_sell_price');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_invoice_details');
    }
};