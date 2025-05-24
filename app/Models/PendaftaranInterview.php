<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranInterview extends Model
{
    use HasFactory;

    protected $table = 'tb_pendaftaran_interview';

    protected $fillable = [
        'siswa_id',
        'sesi_interview_id',
        'nilai',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function sesiInterview()
    {
        return $this->belongsTo(SesiInterview::class, 'sesi_interview_id');
    }
}
