<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusSiswa extends Model
{
    protected $table = 'tb_status_siswa';

    protected $fillable = [
        'status'
    ];
}
