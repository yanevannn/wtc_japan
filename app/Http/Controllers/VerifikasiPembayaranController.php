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

        // Ambil data pembayaran dan siswa terkait
        $pembayaran = Pembayaran::findOrFail($id);
        $siswa = Siswa::findOrFail($pembayaran->siswa_id);

        $statusPendaftaranSaatIni = $siswa->status_pendaftaran_id;

        // Cek apakah semua dokumen siswa sudah terverifikasi
        $semuaDokumenTerverifikasi = !Dokumen::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'verified')
            ->exists();

        // Update status pembayaran
        $pembayaran->status = $request->status;

        // === LOGIKA PENYESUAIAN STATUS PENDAFTARAN ===
        if ($request->status === 'rejected') {
            if ($statusPendaftaranSaatIni == 3) {
                // Jika sebelumnya gagal verifikasi dokumen → gabungan
                $siswa->status_pendaftaran_id = 5; // Gagal Verifikasi Dokumen & Pembayaran
            } else {
                // Jika belum pernah gagal dokumen → gagal verifikasi pembayaran
                $siswa->status_pendaftaran_id = 4; // Gagal Verifikasi Pembayaran
            }
        }

        if ($request->status === 'verified' && $semuaDokumenTerverifikasi) {
            // Semua dokumen dan pembayaran terverifikasi → Diterima
            $siswa->status_pendaftaran_id = 6; // Diterima
            $siswa->status_siswa_id = 2; // Seleksi
            $pembayaran->verified_by = auth()->id();
            $pembayaran->verified_at = now(); // bisa dihilangkan jika pakai timestamp default
        }

        // Simpan perubahan
        $siswa->save();
        $pembayaran->save();

        return redirect()->route('verifikasi.pembayaran-pendaftaran.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function indexPelatihan()
    {
        $data = Pembayaran::with('siswa.user')
            ->where('jenis_pembayaran', 'pelatihan')
            ->where('status', 'pending')
            ->whereNotNull('siswa_id')
            ->get();
        // dd($data);
        return view('main.admin.verifikasi.pembayaran.pelatihan.index', compact('data'));
    }

    public function editPelatihan($id)
    {
        $data = Pembayaran::with('siswa.user')
            ->where('jenis_pembayaran', 'pelatihan')
            ->where('status', 'pending')
            ->whereNotNull('siswa_id')
            ->findOrFail($id);
        // dd($data);
        return view('main.admin.verifikasi.pembayaran.pelatihan.edit', compact('data'));
    }

    public function updatePelatihan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:verified,rejected',
        ]);

        // Ambil data pembayaran dan siswa terkait
        $pembayaran = Pembayaran::findOrFail($id);
        $siswa = Siswa::findOrFail($pembayaran->siswa_id);

        // Update status pembayaran
        $pembayaran->status = $request->status;

        if ($request->status === 'verified') {
            $pembayaran->verified_by = auth()->id();
            $pembayaran->verified_at = now();

            // Buat NIS jika siswa belum punya
            if (empty($siswa->nis)) {
                $angkatan = $siswa->angkatan;

                $tahun = substr($angkatan->tahun, -2);       // 2 digit tahun, misal: '25'
                $kodeMagang = '01';                           // Tetap
                $nomorAngkatan = $angkatan->nomor_angkatan;  // Tanpa formatting

                // Cari NIS terakhir di angkatan ini
                $lastNis = Siswa::where('angkatan_id', $angkatan->id)
                    ->whereNotNull('nis')
                    ->orderByDesc('nis')
                    ->first();

                $nomorUrut = 800; // Default awal
                if ($lastNis && preg_match('/\d{4}$/', $lastNis->nis, $matches)) {
                    $nomorUrut = (int)$matches[0] + 1;
                }

                $nomorUrutFormatted = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

                // Set NIS ke siswa
                $siswa->nis = "{$tahun}.{$kodeMagang}.{$nomorAngkatan}.{$nomorUrutFormatted}";
            }
        }

        // Simpan perubahan
        $siswa->save();
        $pembayaran->save();

        // Redirect dengan notifikasi
        return redirect()
            ->route('verifikasi.pembayaran-pelatihan.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
