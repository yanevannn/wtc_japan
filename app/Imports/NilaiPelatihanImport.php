<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiPelatihan;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class NilaiPelatihanImport implements ToModel
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

        // Cari siswa berdasarkan ID dan NIS (baris 0 dan 2), dan cocokkan dengan angkatan
        $siswa = Siswa::where('id', $row[0])
            ->where('nis', $row[2])
            ->where('angkatan_id', $this->angkatanID)
            ->first();

        // Jika siswa ditemukan, lanjutkan dengan menyimpan nilai
        if ($siswa) {

            // Ambil nilai dari Excel (pastikan urutan sesuai dengan template)
            $hiragana = floatval($row[3]);
            $katakana = floatval($row[4]);
            $kanji    = floatval($row[5]);
            $bunpou   = floatval($row[6]);
            $choukai  = floatval($row[7]);
            $kaiwa    = floatval($row[8]);
            $dokkai   = floatval($row[9]);

            // Simpan/update nilai pelatihan
            NilaiPelatihan::updateOrCreate(
                ['siswa_id' => $siswa->id],
                [
                    'hiragana' => $hiragana,
                    'katakana' => $katakana,
                    'kanji'    => $kanji,
                    'bunpou'   => $bunpou,
                    'choukai'  => $choukai,
                    'kaiwa'    => $kaiwa,
                    'dokkai'   => $dokkai,
                ]
            );

            // Opsional: update status_siswa_id berdasarkan logika tertentu jika diperlukan
            // Contoh: nilai rata-rata >= 70 → tetap di pelatihan
            $rataRata = ($hiragana + $katakana + $kanji + $bunpou + $choukai + $kaiwa + $dokkai) / 7;
            if ($rataRata < 70) {
                $siswa->status_siswa_id = 5; // 5 = Tidak Lulus Pelatihan
            } else {
                $siswa->status_siswa_id = 6; // misal 4 = Siap Penempatan atau status setelah pelatihan
            }

            $siswa->save();

        } else {
            // Log::warning('Siswa tidak ditemukan:', ['id' => $row[0]]);  // Log jika siswa tidak ditemukan
        }
    }
}
