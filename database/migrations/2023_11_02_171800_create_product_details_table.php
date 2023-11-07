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
        Schema::create('product_details', function (Blueprint $table) {
            $table->uuid('detail_id')->primary();
            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onUpdate('cascade');
            $table->uuid('group_id');
            $table->foreign('group_id')
                ->references('group_id')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->uuid('unit_id');
            $table->foreign('unit_id')
                ->references('unit_id')
                ->on('units')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->uuid('supplier_id');
            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('suppliers')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->enum('product_type', ['umum', 'resep dokter']);
            $table->string('product_photo');
            $table->string('product_manufacture');
            $table->string('product_DPN', 15);
            $table->longText('product_sideEffect');
            $table->longText('product_description');
            $table->longText('product_dosage');
            $table->longText('product_indication')->nullable();
            $table->longText('product_notice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
