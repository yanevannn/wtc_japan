<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Models\NilaiPelatihan;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiPelatihanImport;
use App\Exports\NilaiPelatihanTemplateExport;

class NilaiPelatihanController extends Controller
{
    //ADMIN
    public function index($id)
    {
        $angkatan = Angkatan::findOrFail($id);
        // Ambil data siswa dengan status_siswa_id > 3 dan angkatan_id = $id, termasuk relasi nilai pelatihan
        $data = Siswa::where('angkatan_id', $id)
            ->where('status_siswa_id', '>=', 3)
            ->get();

        return view('main.admin.angkatan.data-nilai-pelatihan.index', compact('data', 'angkatan'));
    }

    public function downloadTemplate($id)
    {
        // Ambil data angkatan
        $angkatan = Angkatan::findOrFail($id);

        // Ambil siswa dengan status_siswa_id >= 3 dan angkatan sesuai
        $siswa = Siswa::where('angkatan_id', $id)
            ->where('status_siswa_id', '>=', 3)
            ->with('user:id,fname,lname') // untuk ambil nama lengkap dari relasi user
            ->get();

        // Format data untuk template Excel
        $data = $siswa->map(function ($s) {
            return [
                'siswa_id'  => $s->id,
                'nama'      => $s->user->fname . ' ' . $s->user->lname,
                'nis'       => $s->nis,
                'hiragana'  => '',
                'katakana'  => '',
                'kanji'     => '',
                'bunpou'    => '',
                'choukai'   => '',
                'kaiwa'     => '',
                'dokkai'    => '',
            ];
        });

        // Ekspor data ke file Excel
        return Excel::download(new NilaiPelatihanTemplateExport($data), 'template_nilai_pelatihan.xlsx');
    }

    public function uploadNilai(Request $request, $id)
    {
        // Validasi file yang diunggah
        $request->validate([
            'nilai_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);
        // Ambil file yang diunggah
        $file = $request->file('nilai_file');

        // Proses file Excel dan simpan data ke database
        Excel::import(new NilaiPelatihanImport($id), $file);

        return redirect()->back()->with('success', 'Data nilai berhasil diperbarui.');
    }

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
