<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Gelombang;
use Illuminate\Http\Request;

class NilaiSeleksiController extends Controller
{
    public function index($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $data = Siswa::with([
            'user:id,fname,lname,email',
            'nilaiSeleksi'
        ]) // memuat relasi user
            ->where('gelombang_id', $id)
            ->get();
        return view('main.admin.gelombang_pendaftaran.data_siswa.index', compact('data', 'gelombang'));
    }
}
