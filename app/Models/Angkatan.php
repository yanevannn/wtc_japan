<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    protected $table = 'tb_angkatan';

    protected $fillable = [
        'nomor_angkatan',
        'tahun',
        'status',
        'link_grup',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'angkatan_id');
    }
}
