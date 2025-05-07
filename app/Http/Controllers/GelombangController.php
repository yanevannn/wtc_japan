<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $data = Gelombang::withCount('siswa as jumlah_pendaftar')->latest()->get();
        return view('main.admin.gelombang_pendaftaran.index', compact('data'));
    }

    public function create()
    {
        return view('main.admin.gelombang_pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2024|max:2099',
            'status' => 'required|in:open,closed',
        ]);

        // Jika status yang dipilih adalah 'open'
        if ($request->status === 'open') {
            // Tutup (close) gelombang yang sebelumnya statusnya masih open
            Gelombang::where('status', 'open')->update(['status' => 'closed']);
        }

        $data = [
            'nama_gelombang' => $request->input('nama_gelombang'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
        ];

        Gelombang::create($data);

        return redirect()->route('gelombang.index')->with('success', 'Gelombang created successfully.');
    }

    public function edit($id)
    {
        $data = Gelombang::findOrFail($id);
        return view('main.admin.gelombang_pendaftaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $gelombang = Gelombang::findOrFail($id);

        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2024|max:2099',
            'status' => 'required|in:open,closed',
        ]);

        // Kalau status yang dimasukkan adalah 'open'
        if ($request->status === 'open') {
            // Tutup semua gelombang lain yang statusnya 'open' (kecuali yang ini)
            Gelombang::where('status', 'open')
                ->where('id', '!=', $gelombang->id)
                ->update(['status' => 'closed']);
        }

        // Jika status yang dimasukkan adalah 'closed'
        if ($request->status === 'closed') {
            // Cek apakah ada gelombang lain yang 'open', kecuali gelombang yang sedang diubah
            $openGelombangExist = Gelombang::where('status', 'open')
                ->where('id', '!=', $gelombang->id) // Mengabaikan gelombang yang sedang diubah
                ->exists();

            // Jika tidak ada gelombang 'open', tampilkan error
            if (!$openGelombangExist) {
                return redirect()->back()->with('error', 'Tidak dapat menutup gelombang, karena tidak ada gelombang lain yang statusnya OPEN. Silakan buat gelombang baru dengan status OPEN.');
            }
        }

        // Update data secara aman
        $gelombang->update([
            'nama_gelombang' => $request->nama_gelombang,
            'tahun' => $request->tahun,
            'status' => $request->status,
        ]);

        return redirect()->route('gelombang.index')->with('success', 'Gelombang updated successfully.');
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        // Cek apakah status gelombang adalah 'open'
        if ($gelombang->status === 'open') {
            return redirect()->route('gelombang.index')
                ->with('error', 'Gelombang dengan status OPEN tidak boleh dihapus.');
        }
        // Cek apakah ada siswa yang terhubung dengan gelombang ini
        $jumlahPendaftar = $gelombang->siswa()->count(); // pastikan relasi 'siswa' sudah ada di model

        if ($jumlahPendaftar > 0) {
            return redirect()->route('gelombang.index')
                ->with('error', 'Tidak bisa menghapus gelombang karena ada pendaftar.');
        }

        $gelombang->delete();

        return redirect()->route('gelombang.index')->with('success', 'Gelombang deleted successfully.');
    }
}
