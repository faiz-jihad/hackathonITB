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
        Schema::create('kearifan_lokals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit')->nullable();
            $table->text('penanganan_kearifan_lokal');
            $table->string('nama_obat');
            $table->text('deskripsi_obat');
            $table->string('gambar_obat')->nullable();
            $table->string('link_pembelian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kearifan_lokals');
    }
};
