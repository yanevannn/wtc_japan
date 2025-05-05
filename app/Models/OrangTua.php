<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'tb_orang_tua';
    public $timestamps = false; // Karena hanya ada created_at

    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'nama_ibu',
        'alamat_ayah',
        'alamat_ibu',
        'no_telp_ayah',
        'no_telp_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
