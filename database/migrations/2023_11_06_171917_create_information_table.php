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
        Schema::create('information', function (Blueprint $table) {
            $table->uuid('information_id')->primary();
            $table->string('apotic_name');
            $table->string('apotic_web_name');
            $table->string('SIA_number',50);
            $table->string('SIPA_number',50);
            $table->string('apotic_owner',100);
            $table->string('apotic_address',100);
            $table->string('monday_schedule',25);
            $table->string('tuesday_schedule',25);
            $table->string('wednesday_schedule',25);
            $table->string('thursday_schedule',25);
            $table->string('friday_schedule',25);
            $table->string('saturday_schedule',25);
            $table->string('sunday_schedule',25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
