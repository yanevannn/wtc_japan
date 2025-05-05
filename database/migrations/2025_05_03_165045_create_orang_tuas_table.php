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
        Schema::create('tb_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('alamat_ayah');
            $table->text('alamat_ibu');
            $table->string('no_telp_ayah');
            $table->string('no_telp_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_orang_tua');
    }
};
