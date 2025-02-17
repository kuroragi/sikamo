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
        Schema::table('products', function (Blueprint $table) {
            $table->string('code_product')->nullable()->before('name');
            $table->bigInteger('last_buy')->default(0)->after('id_category');
            $table->bigInteger('selling_price')->default(0)->after('last_buy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('code_product');
            $table->dropColumn('last_buy');
            $table->dropColumn('selling_price');
        });
    }
};
