<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->first();
        // dd($data);
        return view('main.users.pembayaran.index', compact('data'));
    }

    public function create()
    {
        $cekPembayaran = $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->exists();
        if (!$cekPembayaran) {
            return view('main.users.pembayaran.create');
        } else {
            return redirect()->route('pembayaran-pendaftaran')->with('info', "Anda Sudah melaukan pembayaran pendaftaran. Silahkan mengcek status pembayaran !");
        }
    }

    public function store(Request $request)
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
        return redirect()->route('pembayaran-pendaftaran')->with('success', "Upload bukti pembayaran berhasil, silahkan cek status pembayaran secara berkala !");
    }

    public function edit(){
        $data = Pembayaran::where([
            'siswa_id' => auth()->user()->siswa->id,
            'jenis_pembayaran' => 'pendaftaran'
        ])->first();

        return view('main.users.pembayaran.edit', compact('data'));
    }
}
