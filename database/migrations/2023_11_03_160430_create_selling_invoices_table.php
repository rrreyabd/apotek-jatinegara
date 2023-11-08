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
        Schema::create('selling_invoices', function (Blueprint $table) {
            $table->uuid('selling_invoice_id')->primary();
            $table->string('invoice_code', 20)->unique();
            $table->string('cashier_name', 100);
            $table->string('customer_name',100)->nullable();
            $table->string('customer_phone',14)->nullable();
            $table->string('customer_file')->nullable();
            $table->longText('customer_request')->nullable();
            $table->string('customer_bank');
            $table->string('customer_payment',50)->nullable();
            $table->timestamp('order_date');
            $table->timestamp('order_complete')->nullable();
            $table->string('refund_file')->nullable();
            $table->string('reject_comment')->nullable();
            $table->enum('order_status', ['Berhasil', 'Gagal', 'Menunggu Pengembalian', 'Menunggu Konfirmasi', 'Menunggu Pengambilan', 'Offline', 'Refund']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_invoices');
    }
};
