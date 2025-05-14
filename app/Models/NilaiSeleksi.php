<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSeleksi extends Model
{
    protected $table = 'tb_nilai_seleksi';

    protected $fillable = [
        'siswa_id',
        'huruf_jepang',
        'fisik',
        'matematika',
        'koran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
