<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use App\Imports\NilaiSeleksiImport;
use App\Exports\NilaiTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function downloadTemplate($id)
    {
        // Ambil data gelombang berdasarkan ID
        $gelombang = Gelombang::findOrFail($id);

        // Ambil data siswa yang tergabung dalam gelombang tersebut
        $siswa = Siswa::where('gelombang_id', $id)
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
        return Excel::download(new NilaiTemplateExport($data), 'template_nilai.xlsx');
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
}
