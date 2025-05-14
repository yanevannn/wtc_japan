<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiSeleksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class NilaiSeleksiImport implements ToModel
{
    protected $gelombangId;

    public function __construct($gelombangId)
    {
        $this->gelombangId = $gelombangId;
    }

    public function model(array $row)
    {
        // Log untuk melihat setiap baris data yang diproses
        // Log::info('Row data:', $row); // Log data per baris

        // Mencari siswa berdasarkan ID yang ada di Excel dan gelombang yang relevan
        $siswa = Siswa::where('id', $row[0])  // Asumsi kolom pertama adalah ID siswa
            ->where('gelombang_id', $this->gelombangId)  // Memastikan siswa berada di gelombang yang benar
            ->first();

        // Jika siswa ditemukan, lanjutkan dengan menyimpan nilai
        if ($siswa) {
            // Log::info('Siswa ditemukan:', ['id' => $siswa->id]); // Log jika siswa ditemukan

            // Menggunakan updateOrCreate untuk menyimpan atau memperbarui nilai seleksi siswa
            NilaiSeleksi::updateOrCreate(
                ['siswa_id' => $siswa->id],  // Syarat pencarian berdasarkan siswa_id
                [
                    'huruf_jepang' => $row[2],  // Nilai huruf_jepang dari Excel (kolom ke-3)
                    'fisik' => $row[3],  // Nilai fisik dari Excel (kolom ke-4)
                    'matematika' => $row[4],  // Nilai matematika dari Excel (kolom ke-5)
                    'koran' => $row[5],  // Nilai koran dari Excel (kolom ke-6)
                ]
            );
        } else {
            // Log::warning('Siswa tidak ditemukan:', ['id' => $row[0]]);  // Log jika siswa tidak ditemukan
        }
    }
}
