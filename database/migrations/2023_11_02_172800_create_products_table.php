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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('product_id')->primary();
            $table->string('product_code', 20);
            $table->uuid('detail_id');
            $table->foreign('detail_id')
                ->references('detail_id')
                ->on('product_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('product_name');
            $table->timestamp('product_expired');
            $table->integer('product_stock');
            $table->integer('product_buy_price');
            $table->integer('product_sell_price');
            $table->enum('product_status', ['aktif', 'tidak aktif', 'exp']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
