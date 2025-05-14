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
        Schema::create('tb_nilai_seleksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('tb_siswa')->onDelete('cascade');
            $table->integer('huruf_jepang');
            $table->integer('fisik');
            $table->integer('matematika');
            $table->integer('koran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_seleksi');
    }
};
