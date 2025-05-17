<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Dokumen;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class VerifikasiDokumenController extends Controller
{
    public function index()
    {
        $data = Siswa::with(['dokumen', 'statusPendaftaran'])
            ->whereHas('dokumen', function ($query) {
                $query->whereIn('status', ['pending', 'rejected']);
            })
            ->get();
        return view('main.admin.verifikasi.dokumen.index', compact('data'));
    }
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $data = Dokumen::where('siswa_id', $id)->get();
        // return $data;
        return view('main.admin.verifikasi.dokumen.edit', compact('data', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $statusPendaftaranSaatIni = $siswa->status_pendaftaran_id;

        // Ambil semua dokumen terkait siswa
        $dokumenList = Dokumen::where('siswa_id', $id)->pluck('jenis_dokumen');

        // Buat aturan validasi dinamis
        $rules = [];
        foreach ($dokumenList as $jenisDokumen) {
            $rules[$jenisDokumen] = ['required', 'in:verified,rejected'];
        }

        // Validasi semua status per dokumen
        $validated = $request->validate($rules);

        // Update status masing-masing dokumen
        foreach ($validated as $jenisDokumen => $status) {
            Dokumen::where('siswa_id', $id)
                ->where('jenis_dokumen', $jenisDokumen)
                ->update(['status' => $status]);
        }

        // Cek apakah ada dokumen yang rejected
        $adaRejected = Dokumen::where('siswa_id', $id)
            ->where('status', 'rejected')
            ->exists();

        if ($adaRejected) {
            // Jika status sebelumnya adalah "Gagal Verifikasi Pembayaran" (4)
            if ($statusPendaftaranSaatIni == 4) {
                $siswa->status_pendaftaran_id = 5; // Gagal Verifikasi Dokumen & Pembayaran
            } else {
                $siswa->status_pendaftaran_id = 3; // Gagal Verifikasi Dokumen
            }
            $siswa->save();
        } else {
            // Jika semua dokumen sudah verified
            $pembayaranVerified = Pembayaran::where('siswa_id', $id)
                ->where('jenis_pembayaran', 'pendaftaran')
                ->where('status', 'verified')
                ->exists();

            if ($pembayaranVerified) {
                $siswa->status_pendaftaran_id = 6; // Diterima
                $siswa->status_siswa_id = 2;       // Seleksi
                $siswa->save();
            }
        }

        return redirect()->route('verifikasi.dokumen.index')
            ->with('success', 'Verifikasi dokumen berhasil dilakukan.');
    }
}
