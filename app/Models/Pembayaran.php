<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'tb_pembayaran';

    protected $fillable = [
        'siswa_id',
        'jenis_pembayaran',
        'status',
        'jumlah',
        'bukti_pembayaran',
        'tanggal_bayar',
        'verified_by',
        'verified_at',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke user yang verifikasi
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
