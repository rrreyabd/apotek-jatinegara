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
        Schema::create('logs', function (Blueprint $table) {
            $table->uuid('log_id')->primary();
            $table->timestamp('log_time');
            $table->string('invoice_code', 20);
            $table->string('cashier_name');
            $table->string('log_target', 100);
            $table->enum('log_description', ['insert', 'update', 'delete']);
            $table->string('old_value');
            $table->string('new_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
