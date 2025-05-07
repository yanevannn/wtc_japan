<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\StatusPendaftaran;

class StatusPendaftaranController extends Controller
{
    public function index()
    {
        $data = StatusPendaftaran::all();
        return view('main.admin.status_pendaftaran.index', compact('data'));
    }

    public function create()
    {
        return view('main.admin.status_pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => [
                'required',
                Rule::unique('tb_status_pendaftaran', 'status')
            ]
        ]);

        StatusPendaftaran::create([
            'status' => $request->input('status')
        ]);

        return redirect()->route('status-pendaftaran.index')->with('success', 'Data status pendaftaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy($id)
    {
        // Ambil data status pendaftaran
        $statusPendaftaran = StatusPendaftaran::findOrFail($id);

        // Daftar status yang dilindungi (tidak boleh dihapus)
        $protectedStatuses = ['Menunggu Verifikasi', 'Ditolak', 'Diterima'];

        // Cek apakah status termasuk yang dilindungi
        if (in_array($statusPendaftaran->status, $protectedStatuses)) {
            return redirect()->back()->with('error', 'Status ini tidak dapat dihapus karena merupakan status default sistem.');
        }

        // Cek apakah ada relasi di tabel siswa
        $relasiSiswa = Siswa::where('status_pendaftaran_id', $statusPendaftaran->id)->exists();

        if ($relasiSiswa) {
            return redirect()->back()->with('error', 'Status tidak dapat dihapus karena sudah digunakan oleh data siswa.');
        }

        // Jika aman, hapus
        $statusPendaftaran->delete();

        return redirect()->route('status-pendaftaran.index')->with('success', 'Status berhasil dihapus.');
    }
}
