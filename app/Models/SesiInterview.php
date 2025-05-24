<?php

namespace App\Models;

use App\Models\Perusahaan;
use App\Models\PendaftaranInterview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SesiInterview extends Model
{
    use HasFactory;

    protected $table = 'tb_sesi_interview';

    protected $fillable = [
        'perusahaan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'tempat'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function pendaftaranInterview()
    {
        return $this->hasMany(PendaftaranInterview::class, 'sesi_interview_id');
    }
}
