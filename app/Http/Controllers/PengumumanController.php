<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::all();
        return view('main.admin.pengumuman.index', compact('data'));
    }


    public function create()
    {
        return view('main.admin.pengumuman.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $extension = $request->file('file')->getClientOriginalExtension();
        // Nama file: timestamp_pengumuman.ext
        $timestamp = time(); // UNIX timestamp detik sekarang
        $fileName = $timestamp . '_pengumuman.' . $extension;
        // Simpan file ke storage/app/public/pengumuman_files
        $filePath = $request->file('file')->storeAs('pengumuman_files', $fileName, 'public');

        Pengumuman::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'file' => $fileName,
            'created_by' => auth()->user()->id
        ]);
        return redirect()->route('pengumuman.index')->with('success', "Data Berhasis Ditambahkan");
    }


    public function edit($id)
    {
        $data = Pengumuman::findOrFail($id);
        return view('main.admin.pengumuman.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'is_published' => 'required|boolean',
        ]);
        $pengumuman = Pengumuman::findOrFail($id);
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($pengumuman->file) {
                Storage::disk('public')->delete('pengumuman_files/' . $pengumuman->file);
            }
            $extension = $request->file('file')->getClientOriginalExtension();
            // Nama file: timestamp_pengumuman.ext
            $timestamp = time(); // UNIX timestamp detik sekarang
            $fileName = $timestamp . '_pengumuman.' . $extension;
            // Simpan file ke storage/app/public/pengumuman_files
            $filePath = $request->file('file')->storeAs('pengumuman_files', $fileName, 'public');
        } else {
            $fileName = $pengumuman->file; // Gunakan file lama jika tidak ada file baru
        }

        $pengumuman->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'file' => $fileName,
            'is_published' => $request->input('is_published'),
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->route('pengumuman.index')->with('success', "Data Berhasis Diperbarui");
    }


    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        // Hapus file dari storage
        if ($pengumuman->file) {
            Storage::disk('public')->delete('pengumuman_files/' . $pengumuman->file);
        }
        // Hapus data dari database
        $pengumuman->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pengumuman.index')->with('success', "Data Berhasis Dihapus");
    }
}
