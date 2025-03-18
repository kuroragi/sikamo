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
        Schema::table('sale_details', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('code_master');
            $table->bigInteger('id_sale_master');
            $table->bigInteger('sub_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_details', function (Blueprint $table) {
            $table->dropColumn('sub_total');
            $table->dropColumn('id_sale_master');
            $table->string('code_master');
            $table->bigInteger('total');
        });
    }
};
