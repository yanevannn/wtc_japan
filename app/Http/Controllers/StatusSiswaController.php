<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\StatusSiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatusSiswaController extends Controller
{
    public function index()
    {
        $data = StatusSiswa::all();
        return view('main.admin.status_siswa.index', compact('data'));
    }

    public function create()
    {
        return view('main.admin.status_siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => [
                'required',
                Rule::unique('tb_status_siswa', 'status')
            ]
        ]);

        StatusSiswa::create([
            'status' => $request->input('status')
        ]);

        return redirect()->route('status-siswa.index')->with('success', 'Data status siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StatusSiswa::findOrFail($id);
        // Daftar status yang dilindungi (tidak boleh diedit)
        $protectedStatuses = [
            'Pendaftaran',
            'Seleksi',
            'Tidak Lulus Seleksi',
            'Pelatihan',
            'Tidak Lulus Pelatihan',
            'Interview',
            'Interview Ulang',
            'Lulus',
            'Berhenti',
        ];
        // Cek apakah status ini termasuk yang dilindungi
        if (in_array($data->status, $protectedStatuses)) {
            return redirect()->route('status-siswa.index')->with('error', 'Status ini tidak dapat diedit karena merupakan status bawaan sistem.');
        }

        return view('main.admin.status_siswa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        // Daftar status yang dilindungi (tidak boleh diedit)
        $protectedStatuses = [
            'Pendaftaran',
            'Seleksi',
            'Tidak Lulus Seleksi',
            'Pelatihan',
            'Tidak Lulus Pelatihan',
            'Interview',
            'Interview Ulang',
            'Lulus',
            'Berhenti',
        ];

        // Ambil data
        $statusSiswa = StatusSiswa::findOrFail($id);

        // Cek apakah status ini termasuk yang dilindungi
        if (in_array($statusSiswa->status, $protectedStatuses)) {
            return redirect()->route('status-siswa.index')->with('error', 'Status ini tidak dapat diedit karena merupakan status bawaan sistem.');
        }

        // Update data
        $statusSiswa->update([
            'status' => $request->status,
        ]);

        return redirect()->route('status-siswa.index')
            ->with('success', 'Status siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data status siswa
        $statusSiswa = StatusSiswa::findOrFail($id);

        // Daftar status yang dilindungi (tidak boleh dihapus)
        $protectedStatuses = [
            'Pendaftaran',
            'Seleksi',
            'Tidak Lulus Seleksi',
            'Pelatihan',
            'Tidak Lulus Pelatihan',
            'Interview',
            'Interview Ulang',
            'Lulus',
            'Berhenti',
        ];

        // Cek apakah status termasuk yang dilindungi
        if (in_array($statusSiswa->status, $protectedStatuses)) {
            return redirect()->back()->with('error', 'Status ini tidak dapat dihapus karena merupakan status default sistem.');
        }

        // Cek apakah ada relasi di tabel siswa
        $relasiSiswa = Siswa::where('status_siswa_id', $statusSiswa->id)->exists();

        if ($relasiSiswa) {
            return redirect()->back()->with('error', 'Status tidak dapat dihapus karena sudah digunakan oleh data siswa.');
        }

        // Jika aman, hapus
        $statusSiswa->delete();

        return redirect()->route('status-siswa.index')->with('success', 'Status berhasil dihapus.');
    }
}
