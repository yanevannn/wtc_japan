<?php

namespace App\Models;

use App\Models\Perusahaan;
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
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
