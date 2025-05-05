<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

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
        return view('main.admin.pengumuman.edit');
    }


    public function update(Request $request, $id)
    {
        return redirect()->route('pengumuman.index')->with('success', "Data Berhasis Diperbarui");
    }


    public function destroy($id)
    {
        return redirect()->route('pengumuman.index')->with('success', "Data Berhasis Diperbarui");
    }
}
