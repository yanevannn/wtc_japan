<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function create()
    {
        return view('main.users.form.orang-tua');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_ayah' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:255',
            'no_telp_ayah' => 'required|string|max:15',
            'no_telp_ibu' => 'required|string|max:15',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ]);
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();

        $data = [
            'siswa_id' => $siswa->id,
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'alamat_ayah' => $request->input('alamat_ayah'),
            'alamat_ibu' => $request->input('alamat_ibu'),
            'no_telp_ayah' => $request->input('no_telp_ayah'),
            'no_telp_ibu' => $request->input('no_telp_ibu'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
        ];
        // dd($data);

        OrangTua::create($data);
        return redirect()->route('profile')->with('success', 'Data orang tua berhasil disimpan.');
    }

    public function edit()
    {
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        $data = OrangTua::where('siswa_id', $siswa->id)->firstOrFail();
        return view('main.users.form.orang-tua-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_ayah' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:255',
            'no_telp_ayah' => 'required|string|max:15',
            'no_telp_ibu' => 'required|string|max:15',
            'pekerjaan_ayah' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ]);

        $data = [
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'alamat_ayah' => $request->input('alamat_ayah'),
            'alamat_ibu' => $request->input('alamat_ibu'),
            'no_telp_ayah' => $request->input('no_telp_ayah'),
            'no_telp_ibu' => $request->input('no_telp_ibu'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
        ];

        OrangTua::where('id', $id)->update($data);
        return redirect()->route('profile')->with('success', 'Data orang tua berhasil diupdate.');
    }
}
