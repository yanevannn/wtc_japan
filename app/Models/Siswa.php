<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tb_siswa';

    protected $fillable = [
        'tanggal_lahir',
        'nis',
        'jenis_kelamin',
        'alamat',
        'no_ktp',
        'tinggi_badan',
        'berat_badan',
        'golongan_darah',
        // 'status_perkawinan',
        'agama',
        'wa',
        'instagram',
        'angkatan_id',
        'status_pendaftaran_id',
        'status_siswa_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusPendaftaran()
    {
        return $this->belongsTo(StatusPendaftaran::class, 'status_pendaftaran_id');
    }
}
