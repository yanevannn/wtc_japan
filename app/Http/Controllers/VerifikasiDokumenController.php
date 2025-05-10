<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class VerifikasiDokumenController extends Controller
{
    public function index()
    {
        $data = Siswa::with(['dokumen', 'statusPendaftaran'])->where('status_pendaftaran_id', 2)->get();
        // dd($data);
        return view('main.admin.verifikasi.dokumen.index', compact('data'));
    }
    public function edit($id)
    {
        // return view('verifikasi-dokumen.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // return redirect()->route('verifikasi-dokumen.index')->with('success', 'Document verification status updated successfully.');
    }
}
