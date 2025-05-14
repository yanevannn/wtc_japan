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

        // Cek apakah semua dokumen siswa sudah berstatus 'verified'
        $semuaDokumenTerverifikasi = !Dokumen::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'verified')
            ->exists();

        // Update status pembayaran
        $pembayaran->status = $request->status;
        $pembayaran->save();

        // Jika dokumen dan pembayaran sama-sama 'verified', update status pendaftaran siswa
        if ($semuaDokumenTerverifikasi && $request->status === 'verified') {
            $siswa->status_pendaftaran_id = 5;
            $siswa->save();
        }

        // Redirect kembali ke halaman pendaftaran
        return redirect()->route('verifikasi.pembayaran-pendaftaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
