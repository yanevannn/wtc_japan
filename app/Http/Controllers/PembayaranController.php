<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dokumen;
use App\Models\OrangTua;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    //PEMBAYARAN PENDAFTARAN
    public function indexPendaftaran()
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

        $dokumen = Dokumen::where('siswa_id', $siswaId)->get();
        if ($dokumen->isEmpty()) {
            return redirect()->route('form.dokumen.create')
                ->with('error', 'Silahkan upload dokumen terlebih dahulu.');
        }

        $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->first();
        // dd($data);
        return view('main.users.pembayaran.pendaftaran.index', compact('data'));
    }

    public function createPendaftaran()
    {
        $cekPembayaran = $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->exists();
        if (!$cekPembayaran) {
            return view('main.users.pembayaran.pendaftaran.create');
        } else {
            return redirect()->route('pembayaranpendaftaran')->with('info', "Anda Sudah melaukan pembayaran pendaftaran. Silahkan mengcek status pembayaran !");
        }
    }

    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'tanggal_bayar' => "required",
            'bukti_pembayaran' => "required|mimes:jpg,jpeg,png|max:1024"
        ]);

        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
        // Nama file: buktibayar.ext
        $timestamp = time(); // UNIX timestamp detik sekarang
        $fileName = $timestamp . $formattedName .'.'. $extension;
        // Simpan file ke storage/app/public/pengumuman_files
        $filePath = $request->file('bukti_pembayaran')->storeAs('pemabayaran-pendaftaran', $fileName, 'public');

        $data = [
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran',
            'bukti_pembayaran' => $filePath,
            'tanggal_bayar' => $request->input('tanggal_bayar')
        ];
        Pembayaran::create($data);
        Siswa::where('id', auth()->user()->siswa->id)->update([
            'status_pendaftaran_id' => 2, // Update status pendaftaran ke "Menunggu Verifikasi"
        ]);
        return redirect()->route('pembayaranpendaftaran')->with('success', "Upload bukti pembayaran berhasil, silahkan cek status pembayaran secara berkala !");
    }

    public function editPendaftaran(){
        $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->first();

        return view('main.users.pembayaran.pendaftaran.edit', compact('data'));
    }
    
    public function updatePendaftaran(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal_bayar' => 'required|date',
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);

        // Ambil data pembayaran
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus file lama jika ada
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        // Proses file baru
        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
        $timestamp = time();
        $fileName = $timestamp . $formattedName . '.' . $extension;

        // Simpan file
        $filePath = $request->file('bukti_pembayaran')->storeAs('pemabayaran-pendaftaran', $fileName, 'public');

        // Update data di database
        $pembayaran->update([
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'bukti_pembayaran' => $filePath,
            'status' => 'pending', 
        ]);

        // Cek status_pendaftaran siswa dan ubah jika perlu
        $siswa = auth()->user()->siswa;
        if ($siswa) {
            if ($siswa->status_pendaftaran_id == 4) {
                $siswa->update(['status_pendaftaran_id' => 2]);
            } elseif ($siswa->status_pendaftaran_id == 5) {
                $siswa->update(['status_pendaftaran_id' => 3]);
            }
        }

        return redirect()->route('pembayaranpendaftaran')->with('success', 'Upload bukti pembayaran berhasil, silakan cek status pembayaran secara berkala!');
    }

    // PEMBAYARAN PELATIHAN
    public function indexPelatihan()
    {
        $siswaId = auth()->user()->siswa->id;
        $siswa = Siswa::where('id', $siswaId)->first();
        if ($siswa->status_pendaftaran_id < 3) {
            return redirect()->route('dashboard')->with("error", "Anda belum melewati tahapan seleksi");
        }

        $data = Pembayaran::where([
            'siswa_id' => $siswaId,
            'jenis_pembayaran' => 'pelatihan'
        ])->first();

        return view('main.users.pembayaran.pelatihan.index', compact('data'));
    }

    public function createPelatihan()
    {
        $cekPembayaran = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pelatihan'
        ])->exists();
        if (!$cekPembayaran) {
            return view('main.users.pembayaran.pelatihan.create');
        } else {
            return redirect()->route('pembayaranpelatihan.index')->with('info', "Anda Sudah melaukan pembayaran pelatihan. Silahkan mengcek status pembayaran !");
        }
    }

    public function storePelatihan(Request $request)
    {
        $request->validate([
            'tanggal_bayar' => "required",
            'bukti_pembayaran' => "required|mimes:jpg,jpeg,png|max:1024"
        ]);

        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
        // Nama file: buktibayar.ext
        $timestamp = time(); // UNIX timestamp detik sekarang
        $fileName = $timestamp . $formattedName . '.' . $extension;
        // Simpan file ke storage/app/public/pengumuman_files
        $filePath = $request->file('bukti_pembayaran')->storeAs('pemabayaran-pelatihan', $fileName, 'public');

        $data = [
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pelatihan',
            'bukti_pembayaran' => $filePath,
            'tanggal_bayar' => $request->input('tanggal_bayar')
        ];
        Pembayaran::create($data);
        return redirect()->route('pembayaranpelatihan.index')->with('success', "Upload bukti pembayaran berhasil, silahkan cek status pembayaran secara berkala !");
    }

    public function editPelatihan()
    {
        $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pelatihan'
        ])->first();
        return view('main.users.pembayaran.pelatihan.edit', compact('data'));
    }

    public function updatePelatihan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal_bayar' => 'required|date',
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);

        // Ambil data pembayaran
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus file lama jika ada
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        // Proses file baru
        $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $formattedName = strtolower(str_replace(' ', '', auth()->user()->fname . auth()->user()->lname));
        $timestamp = time();
        $fileName = $timestamp . $formattedName . '.' . $extension;

        // Simpan file
        $filePath = $request->file('bukti_pembayaran')->storeAs('pemabayaran-pelatihan', $fileName, 'public');

        // Update data di database
        $pembayaran->update([
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'bukti_pembayaran' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('pembayaranpelatihan.index')->with('success', 'Upload bukti pembayaran berhasil, silakan cek status pembayaran secara berkala!');
    }
}
