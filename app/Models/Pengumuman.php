<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'tb_pengumuman';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'created_by',
        'is_published',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
