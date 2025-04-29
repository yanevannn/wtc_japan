<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    protected $table = 'tb_angkatan';

    protected $fillable = [
        'angkatan',
        'tahun',
    ];
}
