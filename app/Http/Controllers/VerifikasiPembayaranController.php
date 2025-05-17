<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dokumen;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class VerifikasiPembayaranController extends Controller
{
    public function indexPendaftaran()
    {
        $data = Pembayaran::with('siswa.user')
            ->where('jenis_pembayaran', 'pendaftaran')
            ->where('status', 'pending')
            ->whereNotNull('siswa_id')
            ->get();
        // dd($data);
        return view('main.admin.verifikasi.pembayaran.pendaftaran.index', compact('data'));
    }

    public function editPendaftaran($id)
    {
        $data = Pembayaran::with('siswa.user')
            ->where('jenis_pembayaran', 'pendaftaran')
            ->where('status', 'pending')
            ->whereNotNull('siswa_id')
            ->findOrFail($id);
        // dd($data);
        return view('main.admin.verifikasi.pembayaran.pendaftaran.edit', compact('data'));
    }
    public function updatePendaftaran(Request $request, $id)
    {
        // Validasi input: status hanya boleh 'verified' atau 'rejected'
        $request->validate([
            'status' => 'required|in:verified,rejected',
        ]);

        // Ambil data pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id);

        // Ambil siswa terkait
        $siswa = Siswa::findOrFail($pembayaran->siswa_id);

        $statusPendaftaranSaatIni = $siswa->status_pendaftaran_id;

        // Cek apakah semua dokumen siswa sudah berstatus 'verified'
        $semuaDokumenTerverifikasi = !Dokumen::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'verified')
            ->exists();

        // Update status pembayaran
        $pembayaran->status = $request->status;
        $pembayaran->save();

        // === LOGIKA PENYESUAIAN STATUS PENDAFTARAN ===
        if ($request->status === 'rejected') {
            if ($statusPendaftaranSaatIni == 3) {
                // Jika sebelumnya gagal verifikasi dokumen → gabungan
                $siswa->status_pendaftaran_id = 5; // Gagal Verifikasi Dokumen & Pembayaran
            } else {
                // Jika belum pernah gagal dokumen → gagal verifikasi pembayaran
                $siswa->status_pendaftaran_id = 4; // Gagal Verifikasi Pembayaran
            }
            $siswa->save();
        }

        // Jika semua dokumen verified dan pembayaran juga verified → Diterima
        if ($request->status === 'verified' && $semuaDokumenTerverifikasi) {
            $siswa->status_pendaftaran_id = 6; // Diterima
            $siswa->status_siswa_id = 2; // Seleksi
            $siswa->save();
        }

        return redirect()->route('verifikasi.pembayaran-pendaftaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
