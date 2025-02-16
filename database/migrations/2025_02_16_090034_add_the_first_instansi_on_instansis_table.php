<?php

use App\Models\Instansi;
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
        Schema::table('instansis', function (Blueprint $table) {
            //
        });

        $items = [
            [
                'name' => 'kuroragi digital stduio',
                'slogan' => 'kami adalah mitra terpercaya',
                'alamat' => 'jalan parak saluak',
                'kelurahan' => 'tabek panjang',
                'kecamatan' => 'baso',
                'propinsi' => 'sumatera barae',
                'zipcode' => '26192',
                'cp' => 'uum - (+62) 82261317274',
                'email' => '',
                'image' => ''
            ]
        ];

        foreach ($items as $data) {
            Instansi::create($data);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instansis', function (Blueprint $table) {
            //
        });

        Instansi::destroy(1);
    }
};
