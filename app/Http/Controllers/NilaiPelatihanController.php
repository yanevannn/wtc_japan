<?php

namespace App\Http\Controllers;

use App\Models\NilaiPelatihan;
use Illuminate\Http\Request;

class NilaiPelatihanController extends Controller
{
    //ADMIN

    //SISWA
    //Nilai Pelatihan User (Siswa)
    public function indexPelatihanSiswa()
    {
        $data = NilaiPelatihan::with([
            'siswa.user:id,fname,lname,email'
        ])->where('siswa_id', auth()->user()->siswa->id)->first();

        return view('main.users.nilai.pelatihan', compact('data'));
    }
    public function showNilaiPelatihanPdf()
    {
        $data = NilaiPelatihan::with([
            'siswa.user:id,fname,lname,email'
        ])->where('siswa_id', auth()->user()->siswa->id)->first();
        $pdf = PDF::loadView('main.users.nilai.document.a4seleksi', compact('data'));

        return $pdf->stream('data-nilai-seleksi.pdf');
    }
}
