<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Document;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{

    public function index()
    {
        $siswaId = auth()->user()->siswa->id;

        $data = Dokumen::where('siswa_id', $siswaId)->get();

        if ($data->isEmpty()) {
            return redirect()->route('form.dokumen.create')
                ->with('error', 'Silahkan upload dokumen terlebih dahulu.');
        }

        return view('main.users.dokumen.index', compact('data'));
    }


    public function create()
    {
        return view('main.users.form.dokumen');
    }


    public function store(Request $request)
    {
        // Ambil dan format nama depan dan belakang pengguna
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));

        $request->validate([
            'ktp' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf|max:1024',
            'akta' => 'required|file|mimes:pdf|max:1024',
            'ijazah_sd' => 'required|file|mimes:pdf|max:1024',
            'ijazah_smp' => 'required|file|mimes:pdf|max:1024',
            'ijazah_sma' => 'required|file|mimes:pdf|max:1024',
            'ijazah_s1' => 'nullable|file|mimes:pdf|max:1024',
            'paspor' => 'nullable|file|mimes:pdf|max:1024',
        ]); // Format nama (fname + lname tanpa spasi dan kecil semua)

        // Menyimpan dokumen satu per satu
        foreach (['ktp', 'kk', 'akta', 'ijazah_sd', 'ijazah_smp', 'ijazah_sma', 'ijazah_s1', 'paspor'] as $jenisDokumen) {
            if ($request->hasFile($jenisDokumen)) {
                // Format nama file
                $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
                $fileName = time() . "-{$jenisDokumen}-{$formattedName}.pdf";

                // Tentukan path folder dan buat folder jika belum ada
                $folderPath = 'dokumen/' . $jenisDokumen;
                Storage::makeDirectory($folderPath);
                // Simpan file dan simpan data dokumen
                $filePath = $request->file($jenisDokumen)->storeAs($folderPath, $fileName, 'public');

                Dokumen::create([
                    'siswa_id' => auth()->user()->siswa->id,
                    'jenis_dokumen' => $jenisDokumen,
                    'file_path' => $filePath,
                    'uploaded_at' => now(),
                ]);
            }
        }
        Siswa::where('id', auth()->user()->siswa->id)->update([
            'status_pendaftaran_id' => 2, // Update status pendaftaran ke "Menunggu Verifikasi"
        ]);
        // Redirect ke halaman dokumen setelah berhasil
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupload.');
    }

    public function edit($id)
    {
        $siswaId = auth()->user()->siswa->id;

        // Ambil dokumen yang id & siswa_id sesuai
        $data = Dokumen::where('id', $id)
            ->where('siswa_id', $siswaId)
            ->firstOrFail();
        return view('main.users.form.dokumen-edit', compact('data'));
    }


    public function update(Request $request)
    {
        //
    }


    public function destroy()
    {
        //
    }
}
