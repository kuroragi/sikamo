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
        Schema::table('sales', function (Blueprint $table) {
            $table->string('code')->nullable()->change();
            $table->bigInteger('discount')->default(0);
            $table->bigInteger('payment')->default(0);
            $table->boolean('is_finish')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('is_finish');
            $table->dropColumn('payment');
            $table->dropColumn('discount');
        });
    }
};
