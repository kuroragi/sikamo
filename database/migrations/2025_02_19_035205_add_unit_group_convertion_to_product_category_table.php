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
        Schema::table('stock_categories', function (Blueprint $table) {
            $table->boolean('is_convertion')->default(false);
            $table->integer('id_convertion_group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_categories', function (Blueprint $table) {
            $table->dropColumn('is_convertion');
            $table->dropColumn('id_convertion_group');
        });
    }
};
