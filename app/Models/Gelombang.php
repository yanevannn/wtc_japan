<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $table = 'tb_gelombang';

    protected $fillable = [
        'nama_gelombang',
        'tahun',
        'status',
        'link_grup',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'gelombang_id');
    }

    // public function groupSeleksi()
    // {
    //     return $this->hasMany(GroupSeleksi::class, 'gelombang_id');
    // }
}
