<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPendaftaran extends Model
{
    protected $table = 'tb_status_pendaftaran';
    protected $fillable = [
        'status',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
