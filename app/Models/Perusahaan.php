<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'tb_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'tipe',
        'alamat',
        'deskripsi',
    ];

    // Relasi dengan sesi interview (jika sudah ada tabel sesi interview)
    // public function sesiInterview()
    // {
    //     return $this->hasMany(SesiInterview::class, 'perusahaan_id');
    // }
}
