<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiSeleksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class NilaiSeleksiImport implements ToModel
{
    protected $angkatanID;

    public function __construct($angkatanID)
    {
        $this->angkatanID = $angkatanID;
    }

    public function model(array $row)
    {
        // Log untuk melihat setiap baris data yang diproses
        // Log::info('Row data:', $row); // Log data per baris

        // Mencari siswa berdasarkan ID yang ada di Excel dan angkatan yang relevan
        $siswa = Siswa::where('id', $row[0])  // Asumsi kolom pertama adalah ID siswa
            ->where('angkatan_id', $this->angkatanID)  // Memastikan siswa berada di angkatan yang benar
            ->first();

        // Jika siswa ditemukan, lanjutkan dengan menyimpan nilai
        if ($siswa) {

            // Ambil nilai dari kolom Excel
            $hurufJepang = floatval($row[2]);
            $fisik = floatval($row[3]);
            $matematika = floatval($row[4]);
            $koran = floatval($row[5]);

            // Hitung rata-rata
            $rataRata = ($hurufJepang + $fisik + $matematika + $koran) / 4;
            
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

            // Update status siswa berdasarkan rata-rata
            if ($rataRata < 70) {
                $siswa->status_siswa_id = 6; // misal: 7 = Tidak Lulus Seleksi
            } else {
                $siswa->status_siswa_id = 3; // 3 = Pelatihan (default jika lulus)
            }

            $siswa->save();

        } else {
            // Log::warning('Siswa tidak ditemukan:', ['id' => $row[0]]);  // Log jika siswa tidak ditemukan
        }
    }
}
