<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    //ADMIN
    public function index()
    {
        $data = Perusahaan::all();
        return view('main.admin.perusahaan.index', compact('data'));
    }

    public function create()
    {
        return view('main.admin.perusahaan.create');
    }   

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'tipe' => 'required|in:pertanian,industri,makanan',
            'alamat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Perusahaan::create($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Perusahaan::findOrFail($id);
        return view('main.admin.perusahaan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'tipe' => 'required|in:pertanian,industri,makanan',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
