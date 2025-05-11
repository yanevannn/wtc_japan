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

        // ====== Tambahkan logika pengecekan ======

        // Cek apakah semua dokumen siswa sudah "verified"
        $allVerified = Dokumen::where('siswa_id', $id)
            ->where('status', '!=', 'verified')
            ->doesntExist(); // artinya tidak ada yang selain verified

            
        if ($allVerified) {
            // Cek apakah pembayaran pendaftaran sudah ada dan statusnya verified
            $pembayaranAda = Pembayaran::where('siswa_id', $id)
                ->where('jenis_pembayaran', 'pendaftaran')
                ->where('status', 'verified')
                ->exists();

            if ($pembayaranAda) {
                // Jika dua-duanya memenuhi, update status_pendaftaran_id siswa
                $siswa = Siswa::findOrFail($id);
                $siswa->status_pendaftaran_id = 3; // <-- sesuaikan ID "verified"
                $siswa->save();
            }
        }

        return redirect()->route('verifikasi.dokumen.index')
            ->with('success', 'Verifikasi dokumen berhasil dilakukan.');
    }
}
