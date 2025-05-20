<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPelatihan extends Model
{
    use HasFactory;
    
    protected $table = 'tb_nilai_pelatihan';

    protected $fillable = [
        'siswa_id',
        'hiragana',
        'katakana',
        'kanji',
        'bunpou',
        'choukai',
        'kaiwa',
        'dokkai',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
