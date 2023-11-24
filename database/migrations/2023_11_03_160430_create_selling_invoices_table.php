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
            $table->string('cashier_name', 100)->nullable();
            $table->char('customer_id',36)->nullable();
            $table->string('recipient_name',100)->nullable();
            $table->string('recipient_phone',14)->nullable();
            $table->string('recipient_file')->nullable();
            $table->longText('recipient_request')->nullable();
            $table->string('recipient_bank')->nullable();
            $table->string('recipient_payment')->nullable();
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
