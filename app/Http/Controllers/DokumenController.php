<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Document;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{

    public function index()
    {
        $siswaId = auth()->user()->siswa->id;
        $siswa = Siswa::where('id', $siswaId)->first();
        if ($siswa->no_ktp == null) {
            return redirect()->route('form.personal.index')->with("error", "Silahkan Isi data diri terlebih dahulu");
        }
        $orangtua = OrangTua::where('siswa_id', $siswaId)->first();
        if ($orangtua == null) {
            return redirect()->route('form.orang-tua.create')->with("error", "Silahkan Isi data orang tua terlebih dahulu");
        }

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

        // Redirect ke halaman dokumen setelah berhasil
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupload.');
    }

    public function edit($jenisDokumen)
    {
        $siswaId = auth()->user()->siswa->id;
        // Cari dokumen berdasarkan jenis dokumen dan siswa_id
        $data = Dokumen::where('jenis_dokumen', $jenisDokumen)
            ->where('siswa_id', $siswaId)
            ->firstOrFail();
        return view('main.users.form.dokumen-edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $jenisDokumen = $dokumen->jenis_dokumen;

        $request->validate([
            $jenisDokumen => 'required|file|mimes:pdf|max:1024',
        ]);

        $file = $request->file($jenisDokumen);

        // Format nama file
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
        $fileName = time() . "-{$jenisDokumen}-{$formattedName}.pdf";

        // Tentukan folder berdasarkan jenis dokumen
        $folderPath = 'dokumen/' . $jenisDokumen;

        // Hapus file lama jika ada
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        // Simpan file baru ke folder yang sesuai
        Storage::makeDirectory($folderPath);
        $filePath = $file->storeAs($folderPath, $fileName, 'public');

        // Update data dokumen
        $dokumen->update([
            'file_path' => $filePath,
            'uploaded_at' => now(),
            'status' => 'pending',
        ]);

        // Ambil data siswa
        $siswa = auth()->user()->siswa;

        if ($siswa) {
            if ($siswa->status_pendaftaran_id == 3) {
                // Gagal Verifikasi Dokumen → cek dokumen reject lainnya
                $adaDokumenRejectLain = Dokumen::where('siswa_id', $siswa->id)
                    ->where('id', '!=', $dokumen->id)
                    ->where('status', 'rejected')
                    ->exists();

                if (!$adaDokumenRejectLain) {
                    $siswa->update(['status_pendaftaran_id' => 2]); // Menunggu Verifikasi
                }
            } elseif ($siswa->status_pendaftaran_id == 5) {
                // Gagal Verifikasi Dokumen & Pembayaran
                $adaDokumenRejectLain = Dokumen::where('siswa_id', $siswa->id)
                    ->where('id', '!=', $dokumen->id)
                    ->where('status', 'rejected')
                    ->exists();

                if (!$adaDokumenRejectLain) {
                    $siswa->update(['status_pendaftaran_id' => 4]); // Gagal Verifikasi Pembayaran
                }
            }
        }

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui. Silakan tunggu verifikasi.');
    }
}
