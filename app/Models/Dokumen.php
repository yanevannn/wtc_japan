<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'tb_dokumen';

    protected $fillable = [
        'siswa_id',
        'jenis_dokumen',
        'file_path',
        'uploaded_at',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Fungsi untuk mendapatkan pilihan jenis dokumen dalam format
    public static function getJenisDokumenHumanReadable($value)
    {
        $options = [
            'ktp' => 'KTP',
            'kk' => 'Kartu Keluarga',
            'akta' => 'Akta Kelahiran',
            'ijazah_sd' => 'Ijazah SD',
            'ijazah_smp' => 'Ijazah SMP',
            'ijazah_sma' => 'Ijazah SMA',
            'ijazah_s1' => 'Ijazah S1',
            'paspor' => 'Paspor',
        ];

        return $options[$value] ?? ucfirst($value); // Jika tidak ditemukan, return default dengan ucfirst
    }
}
