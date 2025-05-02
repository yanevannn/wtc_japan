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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_lahir')->nullable();
            $table->string('nis')->unique()->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_ktp')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->float('berat_badan')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'Tidak Tahu'])->nullable();
            // $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai']);
            $table->string('agama')->nullable();
            $table->string('wa')->nullable();
            $table->string('instagram')->nullable();

            // Foreign Keys
            $table->unsignedBigInteger('angkatan_id')->nullable();
            $table->unsignedBigInteger('status_pendaftaran_id')->nullable();
            $table->unsignedBigInteger('status_siswa_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('angkatan_id')->references('id')->on('tb_angkatan')->onDelete('set null');
            $table->foreign('status_pendaftaran_id')->references('id')->on('tb_status_pendaftaran')->onDelete('set null');
            $table->foreign('status_siswa_id')->references('id')->on('tb_status_siswa')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa');
    }
};
