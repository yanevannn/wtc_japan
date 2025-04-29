<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tb_siswa';

    protected $fillable = [
        'tempat_tanggal_lahir',
        'nis',
        'umur',
        'jenis_kelamin',
        'alamat',
        'no_ktp',
        'tinggi_badan',
        'berat_badan',
        'golongan_darah',
        'status_perkawinan',
        'hobi',
        'agama',
        'wa',
        'instagram',
        'angkatan_id',
        'status_pendaftaran_id',
        'status_siswa_id',
        'user_id',
    ];
}
