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

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'siswa_id');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'angkatan_id');
    }

    // Relasi ke model Document (tb_dokumen)
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'siswa_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id');
    }

    public function pembayaranPelatihan()
    {
        return $this->hasOne(Pembayaran::class, 'siswa_id')->where('jenis_pembayaran', 'pelatihan');
    }

    public function nilaiSeleksi()
    {
        return $this->hasOne(NilaiSeleksi::class, 'siswa_id');
    }
    public function nilaiPelatihan()
    {
        return $this->hasOne(NilaiPelatihan::class, 'siswa_id');
    }
    public function pendaftaranInterview()
    {
        return $this->hasMany(PendaftaranInterview::class, 'siswa_id');
    }
}
