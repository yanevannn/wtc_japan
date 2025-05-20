<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\NilaiSeleksi;
use Illuminate\Http\Request;
use App\Imports\NilaiSeleksiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiSeleksiTemplateExport;
use App\Models\Angkatan;

class NilaiSeleksiController extends Controller
{
    public function index($id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $data = Siswa::with([
            'user:id,fname,lname,email',
            'nilaiSeleksi'
        ]) // memuat relasi user
            ->where('angkatan_id', $id)
            ->get();
        return view('main.admin.angkatan.data-nilai-seleksi.index', compact('data', 'angkatan'));
    }

    public function downloadTemplate($id)
    {
        // Ambil data angkatan berdasarkan ID
        $angkatan = Angkatan::findOrFail($id);

        // Ambil data siswa yang tergabung dalam angkatan tersebut
        $siswa = Siswa::where('angkatan_id', $id)
            ->whereHas('statusPendaftaran', function ($query) {
                $query->where('status', 'Diterima'); // Menggunakan kolom nama_status di tabel status_pendaftaran
            })
            ->with('user:id,fname,lname') // Menambahkan data user
            ->get();

        // Persiapkan data untuk template Excel (isi nilai kosong)
        $data = $siswa->map(function ($s) {
            return [
                'siswa_id' => $s->id,
                'nama' => $s->user->fname . ' ' . $s->user->lname,
                'huruf_jepang' => '',
                'fisik' => '',
                'matematika' => '',
                'koran' => '',
            ];
        });

        // Ekspor data ke Excel dan kembalikan file untuk diunduh
        return Excel::download(new NilaiSeleksiTemplateExport($data), 'template_nilai.xlsx');
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
        Excel::import(new NilaiSeleksiImport($id), $file);

        return redirect()->back()->with('success', 'Data nilai berhasil diperbarui.');
    }


    //Nilai seleksi User (Siswa)
    public function indexSeleksiSiswa(){
        $data = NilaiSeleksi::with([
            'siswa'
        ])->where('siswa_id', auth()->user()->siswa->id)->first();
      
        return view('main.users.nilai.seleksi', compact('data'));
    }
    
    public function showNilaiSeleksiPdf(){
        $data = NilaiSeleksi::with([
            'siswa.user:id,fname,lname,email'
        ])->where('siswa_id', auth()->user()->siswa->id)->first();
        $pdf = PDF::loadView('main.users.nilai.document.a4seleksi', compact('data'));

        return $pdf->stream('data-nilai-seleksi.pdf');
    }
}
